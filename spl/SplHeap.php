<?php
/**
 * 堆
 * @author: jiangyi
 * @date: 上午10:46 2019/3/6
 */

class JupilerLeague extends SplHeap
{
    /**
     * We modify the abstract method compare so we can sort our
     * rankings using the values of a given array
     */
    public function compare($array1, $array2)
    {
        $values1 = array_values($array1);
        $values2 = array_values($array2);
        if ($values1[0] === $values2[0]) {
            return 0;
        }
        return $values1[0] < $values2[0] ? -1 : 1;
    }
}

$heap = new JupilerLeague();
$heap->insert(['AA Gent' => 15]);
$heap->insert(['Anderlecht' => 20]);
$heap->insert(['Cercle Brugge' => 11]);

// For displaying the ranking we move up to the first node
$heap->top();

// Then we iterate through each node for displaying the result
while ($heap->valid()) {
    foreach ($heap->current() as $team => $score) {
        echo $team . ': ' . $score . PHP_EOL;
    }
    $heap->next();
}
