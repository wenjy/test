<?php
/**
 * @author: 文江义
 * @date: 11:30 2019/4/24
 */
class Operator {

    /**
     * Add two operands
     * @param int $a
     * @param int $b
     * @return int
     */
    public function add($a, $b) {
        return $this->_add($a, $b);
    }

    /**
     * Sub
     */
    public function sub($a, $b) {
        return $a - $b;
    }

    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    public function mul($a, $b) {
        return $a * $b;
    }

    /**
     * Protected methods will not be exposed
     * @param int $a
     * @param int $b
     * @return int
     */
    protected function _add($a, $b) {
        return $a + $b;
    }
}

$server = new Yar_Server(new Operator());
$server->handle();
