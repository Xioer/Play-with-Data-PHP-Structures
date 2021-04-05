<?php
/**
 * 测试入口文件 - 保证一次只引用一个类！！！
 * 在这里直接引用需要的类即可(其实大部分时候php数组直接一把梭了)
 * 示例：
 */
//链表队列
//include "QueueInfo/LinkedListQueue.php";
////链表
//include "LinkedInfo/LinkedList.php";

//二分搜索树
//include "BSTInfo/BST.php";

//集合
//include_once "Set/BSTSet.php";
//include_once "Set/LinkedListSet.php";

//map
//include "MapInfo/LinkedListMap.php";
//BSTMap
//include "MapInfo/BSTMap.php";

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
//$root = new BST();
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
//for ($i = 0; $i < 1000; $i++){
//    $rand = rand(10,10000);
//    $root->add($rand);
//}
//while(!$root->isEmpty()){
//    $arr[] = $root->removeMax();
//}
//
//for ($i = 1; $i < count($arr); $i++){
//    if($arr[$i - 1] < $arr[$i]){
//        echo "排序有问题";
//        exit;
//    }
//}
//print_r($arr);exit;

//集合测试
//$word = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//$set = new BSTSet();
//for ($i = 0; $i < 100; $i++){
//    $rand = rand(1,52);
//    $str = substr($word,$rand,1);
//    $set->add($str);
//}
//$set = new LinkedListSet();
//for ($i = 0; $i < 100; $i++){
//    $rand = rand(1,52);
//    $str = substr($word,$rand,1);
//    $set->add($str);
//}
//print_r($set);


//map测试 - 其实php的key-value数组就能搞定
$start_time = microtime();
$map = new BSTMap();
//$map = new LinkedListMap();
$k = 0;
for ($i = 0; $i < 100000; $i++){
    $k++;
    $map->add($i,$k);
}
//print_r($map);
$end_time = microtime();
print_r(($end_time - $start_time)*1000);








