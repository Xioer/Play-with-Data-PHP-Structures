<?php
namespace QueueInfo;
include "../ArrayInfo/ArrayBase.php";
include "Queue.php";

/**
 * 数组队列
 * Class ArrayQueue
 */
class ArrayQueue implements \QueueInfo\Queue
{
    public $arr;
    public function __construct()
    {
        $this->arr = new \ArrayInfo\ArrayBase();
    }

    /**
     * 这里没有用到，因为PHP的数组本身就是可变长度不需要初始化长度
     * @return int
     */
    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->arr->getSize();
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->arr->isEmpty();
    }

    public function enqueue($e)
    {
        // TODO: Implement enqueue() method.
        $this->arr->addLast($e);
    }

    public function dequeue()
    {
        // TODO: Implement dequeue() method.
        return $this->arr->removeFirst();
    }

    public function getFront()
    {
        // TODO: Implement getFront() method.
        return $this->arr->getFirst();
    }

    public function getCapacity()
    {
        return $this->arr->getCapacity();
    }

    /**
     * Queue - 队列输出
     * @return string
     */
    public function toString()
    {
        $str = 'Queue：front [';
        for ($i = 0;$i < $this->getSize();$i++) {
            $str .= $this->arr->get($i);
            if($i != $this->getSize() - 1){
                $str .= ", ";
            }
        }
        $str .= '] tail';
        return $str;
    }
}