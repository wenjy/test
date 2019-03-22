<?php
/**
 * Created by PhpStorm.
 * User: jiangyi
 * Date: 2017/11/17
 * Time: 下午10:08
 */
class A
{
    public static function get_self() {
        return new self();
    }

    public static function get_static() {
        return new static();
    }
}

class B extends A
{

}

echo get_class(B::get_self()); // A
echo get_class(B::get_static()); // B
echo get_class(A::get_static()); // A

class C {
    public function create1() {
        $class = get_class($this);
        return new $class();
  }
    public function create2() {
        return new static();
    }
}

class D extends C {

}

$b = new D();
var_dump($b->create1(), $b->create2());