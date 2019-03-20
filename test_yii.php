<?php
/**
 * @author: jiangyi
 * @date: 下午8:35 2017/12/20
 */

namespace www\php;
class Obj
{
    private $_basePath = null;
    public function getBasePath()
    {
        if ($this->_basePath === null) {
            $class = new \ReflectionClass($this);
            $this->_basePath = dirname($class->getFileName());
        }

        return $this->_basePath;
    }
}
// yii匹配action
/*$id = 'add-orders1-add';
$methodName = '';
if (preg_match('/^[a-z0-9\\-_]+$/', $id) && strpos($id, '--') === false && trim($id, '-') === $id) {
    $methodName = 'action' . str_replace(' ', '', ucwords(implode(' ', explode('-', $id))));
}
var_dump($methodName);*/

// yii控制器命名空间
/*$class = get_class(new Obj());
var_dump($class);
$controllerNamespace = '';
if (($pos = strrpos($class, '\\')) !== false) {
    var_dump($pos);
    $controllerNamespace = substr($class, 0, $pos) . '\\controllers';
}
var_dump($controllerNamespace);*/

var_dump((new Obj())->getBasePath());
