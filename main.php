<?php
/**
 * 测试入口文件
 * 在这里直接引用需要的类即可
 * 示例：这里演示链表类的使用
 */
//链表队列
include "QueueInfo/LinkedListQueue.php";
//链表
include "LinkedInfo/LinkedList.php";

/**
 * 链表测试 - start
 */
$linked = new \LinkInfo\LinkedList();
$arr = [1,2,3,4,5,4,3,7,8,8,9];
foreach ($arr as $value){
    $linked->addLast($value);
}
echo "\n";
print_r($linked->toString());
echo "\n";
$head = $linked->getDummyHeadLinked($linked);
$linked->removeRecursionVal($head,6);
print_r($linked->toString());
//链表测试 - end








