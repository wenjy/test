<?php
/**
 * @author: 文江义
 * @date: 19:59 2019/8/19
 */
class API {
    /**
     * the doc info will be generated automatically into service info page.
     * @params
     * @return
     */
    public function some_method($parameter, $option = "foo") {
        return $parameter;
    }

    protected function client_can_not_see() {
    }
}

$service = new Yar_Server(new API());
$service->handle();
