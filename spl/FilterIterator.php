<?php
/**
 * @author: jiangyi
 * @date: 下午1:51 2018/11/12
 */
/*** a simple array ***/
$animals = ['koala', 'kangaroo', 'wombat', 'wallaby', 'emu', 'NZ' => 'kiwi', 'kookaburra', 'platypus'];

class CullingIterator extends FilterIterator
{

    /*** The filteriterator takes  a iterator as param: ***/
    public function __construct(Iterator $it)
    {
        parent::__construct($it);
    }

    /*** check if key is numeric ***/
    function accept()
    {
        return is_numeric($this->key());
    }

}

/*** end of class ***/
$cull = new CullingIterator(new ArrayIterator($animals));

foreach ($cull as $key => $value) {
    echo $key . '=>' . $value . PHP_EOL;
}
