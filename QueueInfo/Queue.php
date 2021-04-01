<?php
namespace QueueInfo;
/**
 * 队列 - 接口
 * Interface Queue
 */
interface Queue{

    public function getSize();
    public function isEmpty();
    public function enqueue($e);
    public function dequeue();
    public function getFront ();

}