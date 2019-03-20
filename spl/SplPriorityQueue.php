<?php
/**
 * @author: jiangyi
 * @date: 上午11:32 2019/3/6
 */

class PQtest extends SplPriorityQueue
{
    public function compare($priority1, $priority2)
    {
        if ($priority1 === $priority2) {
            return 0;
        }
        return $priority1 < $priority2 ? -1 : 1;
    }
}

$objPQ = new PQtest();

$objPQ->insert('A', 3);
$objPQ->insert('B', 6);
$objPQ->insert('C', 1);
$objPQ->insert('D', 2);

echo "COUNT->" . $objPQ->count() . PHP_EOL;

//mode of extraction
$objPQ->setExtractFlags(PQtest::EXTR_BOTH);

//Go to TOP
$objPQ->top();

while ($objPQ->valid()) {
    $value = $objPQ->current();
    echo 'data->' . $value['data'] . '==priority->' . $value['priority'] . PHP_EOL;
    $objPQ->next();
}
