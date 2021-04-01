<?php
namespace ArrayStackInfo;
/**
 * 栈-数据结构
 * Class Stack
 */
interface Stack{
    public function getSize();
    public function isEmpty();
    public function push($e);
    public function pop();
    public function peek();

}