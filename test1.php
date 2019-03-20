<?php
/**
 * @author: jiangyi
 * @date: 上午10:27 2017/12/19
 */

class A extends Serialize
{
    public function format(&$item, $key, $param = '')
    {
        //$item = 'AA' . $item;
        $item = $this->formatUrl($item, $key);
    }

    public function formatUrl($item, $key, $param = '') {
        if ($key == 'a') {
            $item = 'AAU' . $item;
        }
        return $item;
    }
}

class B extends Serialize
{
    public function format(&$item, $key, $param = '')
    {
        if ($param == 2) {
            $item = '2BB' . $item;
        } else {
            $item = 'BB' . $item;
        }
    }
}

abstract class Serialize
{
    abstract public function format(&$item, $key, $param = '');
}

class FormatItems
{
    public function format()
    {
        $items = [
            'a' => '1111',
            'b' => '2222',
            'c' => '3333',
            'd' => [
                'a' => '1111',
                'b' => '2222',
                'c' => '3333',
                'd' => [
                    'a' => '1111',
                    'b' => '2222',
                    'c' => '3333',
                    'd' => '4444',
                ]
            ]
        ];

        foreach (['A'=>1,'B'=>2] as $class_name => $param) {
            $class = new $class_name();
            array_walk_recursive($items, [&$class, 'format'], $param);
        }

        var_dump($items);
    }
}

(new FormatItems())->format();