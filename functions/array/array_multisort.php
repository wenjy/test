<?php
/**
*bool array_multisort ( array ar1 [, mixed arg [, mixed ... [, array ...]]] )
*如果成功则返回 TRUE，失败则返回 FALSE。 
*array_multisort() 可以用来一次对多个数组进行排序，或者根据某一维或多维对多维数组进行排序。 
*关联（string）键名保持不变，但数字键名会被重新索引。 
*输入数组被当成一个表的列并以行来排序――这类似于 SQL 的 ORDER BY 子句的功能。第一个数组是要排序的主要数组。
*数组中的行（值）比较为相同的话就按照下一个输入数组中相应值的大小来排序，依此类推。 
*本函数的参数结构有些不同寻常，但是非常灵活。第一个参数必须是一个数组。接下来的每个参数可以是数组或者是下面列出的排序标志。 
*排序顺序标志： 
*SORT_ASC - 按照上升顺序排序
*SORT_DESC - 按照下降顺序排序
*排序类型标志： 
*SORT_REGULAR - 将项目按照通常方法比较
*SORT_NUMERIC - 将项目按照数值比较
*SORT_STRING - 将项目按照字符串比较
*每个数组之后不能指定两个同类的排序标志。每个数组后指定的排序标志仅对该数组有效 - 在此之前为默认值 SORT_ASC 和 SORT_REGULAR。 
*/

//例 1. 对多个数组排序
$ar1 = array("10", 100, 100, "a");
$ar2 = array(1, 3, "2", 1);
array_multisort($ar1, $ar2);

var_dump($ar1);
var_dump($ar2);

//例 2. 对多维数组排序
$ar = array (array ("10", 100, 100, "a"), array (1, 3, "2", 1));
array_multisort ($ar[0], SORT_ASC, SORT_STRING,
                 $ar[1], SORT_NUMERIC, SORT_DESC);
var_dump($ar);

$ar = array(
       array("10", 11, 100, 100, "a"),
       array(1, 2, "2", 3, 1)
      );
array_multisort($ar[0], SORT_ASC, SORT_STRING,
                $ar[1], SORT_NUMERIC, SORT_DESC);
var_dump($ar);

//数据全都存放在名为 data 的数组中。这通常是通过循环从数据库取得的结果，例如 mysql_fetch_assoc()。 
$data[] = array('volume' => 67, 'edition' => 2);
$data[] = array('volume' => 86, 'edition' => 1);
$data[] = array('volume' => 85, 'edition' => 6);
$data[] = array('volume' => 98, 'edition' => 2);
$data[] = array('volume' => 86, 'edition' => 6);
$data[] = array('volume' => 67, 'edition' => 7);

// 取得列的列表
foreach ($data as $key => $row) {
    $volume[$key]  = $row['volume'];
    $edition[$key] = $row['edition'];
}

// 将数据根据 volume 降序排列，根据 edition 升序排列
// 把 $data 作为最后一个参数，以通用键排序
array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data);

var_dump($data);

//例 5. 不区分大小写字母排序
//SORT_STRING 和 SORT_REGULAR 都是区分大小写字母的，大写字母会排在小写字母之前。 
//要进行不区分大小写的排序，就要按照原数组的小写字母拷贝来排序。
$array = array('Alpha', 'atomic', 'Beta', 'bank');
$array_lowercase = array_map('strtolower', $array);

array_multisort($array_lowercase, SORT_ASC, SORT_STRING, $array);

var_dump($array);

$grade = array("score" => array(70, 95, 70.0, 60, "70"),
               "name" => array("Zhang San", "Li Si", "Wang Wu",
                               "Zhao Liu", "Liu Qi"));
array_multisort($grade["score"], SORT_NUMERIC, SORT_DESC,
                // 将分数作为数值，由高到低排序
                $grade["name"], SORT_STRING, SORT_ASC);
                // 将名字作为字符串，由小到大排序
var_dump($grade);
//本例中对包含成绩的数组 $grade 按照分数（score）由高到低进行排序，分数相同的人则按照名字（name）由小到大排序。
//排序后李四 95 分为第一名，赵六 60 分为第五名没有异议。张三、王五和刘七都是 70 分，
//他们的名次则由其姓名的字母顺序排列，Liu 在前，Wang 在后而 Zhang 在最后。
//为了区别，三个 70 分分别用了整数，浮点数和字符串来表示，可以在程序输出中清楚地看到它们排序的结果。 


