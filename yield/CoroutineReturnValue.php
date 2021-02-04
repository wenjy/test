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

/**
 * @param $value
 * @return CoroutineReturnValue
 */
function retval($value): CoroutineReturnValue
{
    return new CoroutineReturnValue($value);
}
