<?php
//include "StackInfo/LinkedListStack.php";

include "QueueInfo/LinkedListQueue.php";
include "LinkedInfo/LinkedList.php";

/**
 * 链表测试
 */
$linked = new \LinkInfo\LinkedList();
$arr = [1,2,3,4,5,4,3,2,5,6,7,8,8,9];
foreach ($arr as $value){
    $linked->addLast($value);
}
echo "\n";
print_r($linked->toString());
echo "\n";
$head = $linked->getDummyHeadLinked($linked);
$linked->removeRecursionVal($head,2);
print_r($linked->toString());








