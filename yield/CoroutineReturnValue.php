<?php

/**
 * @author: jiangyi
 * @date: 上午10:42 2019/3/14
 */
class CoroutineReturnValue
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}

function retval($value)
{
    return new CoroutineReturnValue($value);
}
