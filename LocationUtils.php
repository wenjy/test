<?php

/**
 * 各地图API坐标系统比较与转换;
 * WGS84坐标系：即地球坐标系，国际上通用的坐标系。设备一般包含GPS芯片或者北斗芯片获取的经纬度为WGS84地理坐标系,
 * 谷歌地图采用的是WGS84地理坐标系（中国范围除外）;
 * GCJ02坐标系：即火星坐标系，是由中国国家测绘局制订的地理信息系统的坐标系统。由WGS84坐标系经加密后的坐标系。
 * 谷歌中国地图和搜搜中国地图采用的是GCJ02地理坐标系; BD09坐标系：即百度坐标系，GCJ02坐标系经加密后的坐标系;
 * 搜狗坐标系、图吧坐标系等，估计也是在GCJ02基础上加密而成的。
 */
class LocationUtils
{

    // a = 6369000.0, 1/f = 298.3
    // f = 0.0033523298692591
    // 1 - f = 0.9966476701307409
    // b = a * (1 - f)
    // b = 6347649.011062689
    // ee = (a^2 - b^2) / a^2;
    // a^2 = 40564161000000
    // b^2 = 40292647967645.13
    const EARTH_RADIUS = 6378.137;
    const PI = 3.1415926535897932384626; // 圆周率
    const R = 6369000.0; // 地球半径
    const EE = 0.006693421622966021;

    private static function rad($d)
    {
        return $d * self::PI / 180.0;
    }

    /**
     * 84 to 火星坐标系 (GCJ-02) World Geodetic System ==> Mars Geodetic System
     *
     * @param $lng
     * @param $lat
     * @return Gps
     */
    public static function gps84ToGcj02($lng, $lat)
    {
        if (self::outOfChina($lng, $lat)) {
            return null;
        }
        $dLat = self::transformLat($lng - 105.0, $lat - 35.0);
        $dLon = self::transformLng($lng - 105.0, $lat - 35.0);
        $radLat = $lat / 180.0 * self::PI;
        $magic = sin($radLat);
        $magic = 1 - self::EE * $magic * $magic;
        $sqrtMagic = sqrt($magic);
        $dLat = ($dLat * 180.0) / ((self::R * (1 - self::EE)) / ($magic * $sqrtMagic) * self::PI);
        $dLon = ($dLon * 180.0) / (self::R / $sqrtMagic * cos($radLat) * self::PI);
        $mgLat = $lat + $dLat;
        $mgLon = $lng + $dLon;
        return new Gps($mgLon, $mgLat);
    }


    /**
     * * 火星坐标系 (GCJ-02) to 84 * *
     *
     * @param $lng
     * @param $lat
     * @return Gps
     */
    public static function gcj02ToGps84($lng, $lat)
    {
        $gps = self::transform($lng, $lat);
        $lontitude = $lng * 2 - $gps->getLng();
        $latitude = $lat * 2 - $gps->getLat();
        return new Gps($lontitude, $latitude);
    }


    /**
     * 火星坐标系 (GCJ-02) 与百度坐标系 (BD-09) 的转换算法 将 GCJ-02 坐标转换成 BD-09 坐标
     *
     * @param $lng
     * @param $lat
     * @return Gps
     */
    public static function gcj02ToBd09($lng, $lat)
    {
        $x = $lng;
        $y = $lat;
        $z = sqrt($x * $x + $y * $y) + 0.00002 * sin($y * self::PI);
        $theta = atan2($y, $x) + 0.000003 * cos($x * self::PI);
        $bdLon = $z * cos($theta) + 0.0065;
        $bdLat = $z * sin($theta) + 0.006;
        return new Gps($bdLon, $bdLat);
    }


    /**
     * 火星坐标系 (GCJ-02) 与百度坐标系 (BD-09) 的转换算法 * * 将 BD-09 坐标转换成GCJ-02 坐标 * *
     *
     * @param $bdLat
     * @param $bdLon
     * @return Gps
     */
    public static function bd09ToGcj02($bdLon, $bdLat)
    {
        $x = $bdLon - 0.0065;
        $y = $bdLat - 0.006;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * self::PI);
        $theta = atan2($y, $x) - 0.000003 * cos($x * self::PI);
        $ggLon = $z * cos($theta);
        $ggLat = $z * sin($theta);
        return new Gps($ggLon, $ggLat);
    }


    /**
     * (BD-09)-->84
     *
     * @param $lng
     * @param $lat
     * @return Gps
     *
     */
    public static function bd09ToGps84($lng, $lat)
    {


        $gcj02 = self::bd09ToGcj02($lng, $lat);
        $map84 = self::gcj02ToGps84($gcj02->getLng(), $gcj02->getLat());
        return $map84;
    }

    /**
     * 是否在中国境内
     *
     * @param $lng
     * @param $lat
     * @return bool
     */
    public static function outOfChina($lng, $lat)
    {
        if ($lng < 72.004 || $lng > 137.8347) {
            return true;
        }
        if ($lat < 0.8293 || $lat > 55.8271) {
            return true;
        }
        return false;
    }


    public static function transform($lng, $lat)
    {
        if (self::outOfChina($lng, $lat)) {
            return new Gps($lng, $lat);
        }
        $dLat = self::transformLat($lng - 105.0, $lat - 35.0);
        $dLon = self::transformLng($lng - 105.0, $lat - 35.0);
        $radLat = $lat / 180.0 * self::PI;
        $magic = sin($radLat);
        $magic = 1 - self::EE * $magic * $magic;
        $sqrtMagic = sqrt($magic);
        $dLat = ($dLat * 180.0) / ((self::R * (1 - self::EE)) / ($magic * $sqrtMagic) * self::PI);
        $dLon = ($dLon * 180.0) / (self::R / $sqrtMagic * cos($radLat) * self::PI);
        $mgLat = $lat + $dLat;
        $mgLon = $lng + $dLon;
        return new Gps($mgLon, $mgLat);
    }


    public static function transformLat($x, $y)
    {
        $ret = -100.0 + 2.0 * $x + 3.0 * $y + 0.2 * $y * $y + 0.1 * $x * $y + 0.2 * sqrt(abs($x));
        $ret += (20.0 * sin(6.0 * $x * self::PI) + 20.0 * sin(2.0 * $x * self::PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($y * self::PI) + 40.0 * sin($y / 3.0 * self::PI)) * 2.0 / 3.0;
        $ret += (160.0 * sin($y / 12.0 * self::PI) + 320 * sin($y * self::PI / 30.0)) * 2.0 / 3.0;
        return $ret;
    }


    public static function transformLng($x, $y)
    {
        $ret = 300.0 + $x + 2.0 * $y + 0.1 * $x * $x + 0.1 * $x * $y + 0.1 * sqrt(abs($x));
        $ret += (20.0 * sin(6.0 * $x * self::PI) + 20.0 * sin(2.0 * $x * self::PI)) * 2.0 / 3.0;
        $ret += (20.0 * sin($x * self::PI) + 40.0 * sin($x / 3.0 * self::PI)) * 2.0 / 3.0;
        $ret += (150.0 * sin($x / 12.0 * self::PI) + 300.0 * sin($x / 30.0 * self::PI)) * 2.0 / 3.0;
        return $ret;
    }


    /**
     * 计算两个经纬度直接的距离
     *
     * @param $lng1
     * @param $lat1
     * @param $lng2
     * @param $lat2
     * @return bool
     */
    public static function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $distance = 0;
        $gps1 = self::gcj02ToGps84($lng1, $lat1);
        $gps2 = self::gcj02ToGps84($lng2, $lat2);
        $lat1 = $gps1->getLat();
        $lat2 = $gps2->getLat();
        $lng1 = $gps1->getLng();
        $lng2 = $gps2->getLng();
        try {
            $distance = round(
                self::R * 2 * asin(sqrt(pow(sin(($lat1 * self::PI / 180 - $lat2 * self::PI / 180) / 2), 2)
                    + cos($lat1 * self::PI / 180) * cos($lat2 * self::PI / 180)
                    * pow(sin(($lng1 * self::PI / 180 - $lng2 * self::PI / 180) / 2), 2))));
        } catch (Exception $e) {
            echo $e->__toString();
        }

        return $distance;
    }

}

class Gps
{
    protected $lat;
    protected $lng;

    public function __construct($lng, $lat)
    {
        $this->lng = $lng;
        $this->lat = $lat;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLng()
    {
        return $this->lng;
    }
}

$lat1 = 23.12449508990545;
$lng1 = 113.36178302764893;
$lat2 = 23.12463;
$lng2 = 113.36199;
var_dump(LocationUtils::getDistance($lat1, $lng1, $lat2, $lng2));
