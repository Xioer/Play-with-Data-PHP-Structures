<?php
namespace QueueInfo;
include "../ArrayInfo/ArrayBase.php";
include "Queue.php";

/**
 * 循环队列
 * Class LoopQueue
 */
class LoopQueue implements \QueueInfo\Queue
{
    private $arr = [];
    private $front = 0;
    private $tail = 0;
    private $size = 0;
    private $max = 10;

    public function __construct($capacity = 0){}

    public function getCapacity()
    {
        return ($this->max) - 1;
    }


    /**
     * @return int
     * 时间复杂度 O(1)
     */
    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->size;
    }

    /**
     * @return bool
     * 时间复杂度 O(1)
     */
    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->front == $this->tail;
    }

    /**
     * @param $e
     * 时间复杂度 O(1) 均摊
     */
    public function enqueue($e)
    {
        // TODO: Implement enqueue() method.
        if(($this->tail + 1) % $this->max == $this->front){
            $this->max = $this->max * 2;

        }else{
            $this->arr[$this->tail] = $e;
            $this->tail = ($this->tail + 1) % $this->max;
            $this->size++;
        }
    }

    /**
     * @return mixed
     * 时间复杂度 O(1) 均摊
     */
    public function dequeue()
    {
        // TODO: Implement dequeue() method.
        if($this->isEmpty()){
            echo "队列为空";
        }
        $ret = $this->arr[$this->front];
        unset($this->arr[$this->front]);
        $this->front = ($this->front + 1) % $this->max;
        $this->size--;

        return $ret;
    }

    /**
     * @return mixed
     * 时间复杂度 O(1)
     */
    public function getFront()
    {
        // TODO: Implement getFront() method.
        if($this->isEmpty()){
            echo "队列为空";
        }
        return $this->arr[$this->front];
    }

    /**
     * Queue - 循环队列输出
     * @return string
     */
    public function toString()
    {
        printf('Queue：size=%d，capacity=%d',$this->getSize(),$this->getCapacity());
        echo "\n";
        $str = 'front [';
        for ($i = $this->front;$i != $this->tail; $i = ($i+1) % $this->max) {
            $str .= $this->arr[$i];
            if(($i + 1) % $this->max != $this->tail){
                $str .= ", ";
            }
        }
        $str .= '] tail';
        return $str;
    }
}
//测试
$arr = new LoopQueue();
for ($i = 0;$i < 10;$i++){
    $arr->enqueue($i);
    echo "\n";
    if($i % 3 == 2){
        $arr->dequeue();
    }
    print_r($arr->toString());
}
