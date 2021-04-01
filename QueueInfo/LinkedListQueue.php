<?php
include "Queue.php";
/**
 * 节点Node类
 * Class Node
 */
class Node
{

    public $e;
    public $next;

    public function __construct($e = null, $next = null)
    {
        $this->e = $e;
        $this->next = $next;
    }
}

/**
 * 链表队列
 * Class LinkedListQueue
 * @package QueueInfo
 */
class LinkedListQueue implements \QueueInfo\Queue
{

    //头节点
    private $head;
    //尾节点
    private $tail;
    //节点大小
    private $size;

    public function __construct($head = null, $tail = null)
    {
        $this->tail = $tail;
        $this->head = $head;
        $this->size = 0;
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->size;
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->size == 0;
    }

    /**
     * 入队
     * @param $e
     */
    public function enqueue($e)
    {
        // TODO: Implement enqueue() method.
        if(is_null($this->tail)){
            $this->tail = new Node($e);
            $this->head = $this->tail;
        }else{
            $this->tail->next = new Node($e);
            $this->tail = $this->tail->next;
        }
        $this->size++;
    }


    /**
     * 出队
     * @return mixed
     */
    public function dequeue()
    {
        // TODO: Implement dequeue() method.
        if($this->isEmpty()) {
            echo "队列为空";
        }else{
            $retNode = $this->head;
            $this->head = $this->head->next;
            $retNode->next = null;
            if($this->head == null){
                $this->tail = null;
            }
            $this->size--;
            return $retNode->e;
        }
    }

    /**
     * 获取第一个元素
     * @return mixed
     */
    public function getFront()
    {
        // TODO: Implement getFront() method.
        if($this->isEmpty()) {
            echo "队列为空";
        }else{
            return $this->head->e;
        }
    }


    public function toString()
    {
        $str = 'Queue: front ';
        $cur = $this->head;
        while (!is_null($cur)){
            $str .= $cur->e . '->';
            $cur = $cur->next;
        }
        $str .= 'null tail';
        return $str;
    }
}