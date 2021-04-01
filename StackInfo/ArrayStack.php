<?php
namespace ArrayStackInfo;
//include "ArrayBase.php";
include "Stack.php";
include "../ArrayInfo/ArrayBase.php";

/**
 * 栈-数据结构
 * Class Stack
 */
class ArrayStack implements Stack
{
    public $arr;
    public function __construct()
    {
        $this->arr = new \ArrayInfo\ArrayBase();
    }

    public function getSize(){
        return $this->arr->getSize();
    }
    public function isEmpty(){
        $this->arr->isEmpty();
    }
    public function push($e){
        $this->arr->addLast($e);
    }
    public function pop(){
        $this->arr->removeLast();
    }
    public function peek(){
        $this->arr->getLast();
    }

    /**
     * Stack - 数据栈输出
     * @return string
     */
    public function toString()
    {
        $str = 'Stack：[';
        for ($i = 0;$i < $this->getSize();$i++) {
            $str .= $this->arr->get($i);
            if($i != $this->getSize() - 1){
                $str .= ", ";
            }
        }
        $str .= '] top';
        return $str;
    }
}



