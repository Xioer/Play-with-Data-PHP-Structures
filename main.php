<?php
/**
 * 测试入口文件
 * 在这里直接引用需要的类即可
 * 示例：
 */
//链表队列
//include "QueueInfo/LinkedListQueue.php";
////链表
//include "LinkedInfo/LinkedList.php";

//二分搜索树
include "BSTInfo/BST.php";

/**
 * 链表测试 - start
 */
//$linked = new \LinkInfo\LinkedList();
//$arr = [1,2,3,4,5,4,3,7,8,8,9];
//foreach ($arr as $value){
//    $linked->addLast($value);
//}
//echo "\n";
//print_r($linked->toString());
//echo "\n";
//$head = $linked->getDummyHeadLinked($linked);
//$linked->removeRecursionVal($head,6);
//print_r($linked->toString());
//链表测试 - end

//二分搜索树测试用例
$root = new BST();
//$arr = [5,3,6,8,4,2];
//foreach ($arr as $value){
//    $root->add($value);
//}
//前序遍历
//print_r($root->preOrder());
//echo "\n";
////中序遍历
//print_r($root->inOrder());
//echo "\n";
////后序遍历
//print_r($root->postOrder());

//层序遍历
//$root->levelOrder();

//test removeMin
//for ($i = 0; $i < 1000; $i++){
//    $rand = rand(10,10000);
//    $root->add($rand);
//}
//while(!$root->isEmpty()){
//    $arr[] = $root->removeMin();
//}
//
//for ($i = 1; $i < count($arr); $i++){
//    if($arr[$i - 1] > $arr[$i]){
//        echo "排序有问题";
//        exit;
//    }
//}

//test removeMax
for ($i = 0; $i < 1000; $i++){
    $rand = rand(10,10000);
    $root->add($rand);
}
while(!$root->isEmpty()){
    $arr[] = $root->removeMax();
}

for ($i = 1; $i < count($arr); $i++){
    if($arr[$i - 1] < $arr[$i]){
        echo "排序有问题";
        exit;
    }
}
print_r($arr);exit;








