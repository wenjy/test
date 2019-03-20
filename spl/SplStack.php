<?php
/**
 * SplStack类通过使用一个双向链表来提供栈的主要功能
 *
 * @author: jiangyi
 * @date: 上午10:29 2019/3/6
 */

$q = new SplStack();

$q[] = 1;
$q[] = 2;
$q[] = 3;
$q->push(4);
$q->add(4, 5);

$q->rewind();
while ($q->valid()) {
    echo $q->current(), "\n";
    $q->next();
}

class Stack
{

    private $splstack;

    function __construct(\SplStack $splstack)
    {
        $this->splstack = $splstack;
    }

    public function calculateSomme()
    {

        if ($this->splstack->count() > 1) {
            $val1 = $this->splstack->pop();
            $val2 = $this->splstack->pop();
            $val = $val1 + $val2;
            $this->splstack->push($val);
            $this->calculateSomme();
        }
    }

    /**
     *
     * @return integer
     */
    public function displaySomme()
    {
        $result = $this->splstack->pop();
        return $result;
    }

}

$splstack = new \SplStack();

$splstack->push(10);
$splstack->push(10);
$splstack->push(10);

$stack = new Stack($splstack);
$stack->calculateSomme();
echo $stack->displaySomme() . PHP_EOL; // 30

$stack = new SplStack();
$stack->push('a');
$stack->push('b');
$stack->push('c');
echo $stack->offsetGet(0);
$stack->offsetSet(0, 'C'); # the last element has index zero

$stack->rewind();

while ($stack->valid()) {
    echo $stack->current(), PHP_EOL;
    $stack->next();
}
