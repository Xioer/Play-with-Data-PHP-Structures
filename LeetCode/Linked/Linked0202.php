<?php

class ListNode {
     public $val = 0;
     public $next = null;
     function __construct($val) { $this->val = $val; }
 }

/**
 * 返回倒数第 k 个节点
 * Class Linked0202
 */
class Linked0202 {

    /**
     * @param ListNode $head
     * @param Integer $k
     * @return Integer
     */
    function kthToLast($head, $k) {

        //计算链表的长度 - 然后找长度 - $k的链表数据
//        $cur = $head;
//        $index = 0;
//
//        while ($cur != null){
//            $cur = $cur->next;
//            $index++;
//        }
//        $cur = $head;
//        for ($i = 0; $i < $index - $k; $i++){
//            $cur = $cur->next;
//        }
//        return $cur->val;

        //双指针移动
        $p = $head;
        for($i=0; $i<$k; $i++){
            $p = $p->next;
        }
        while($p != null){
            $p = $p->next;
            $head = $head->next;
        }
        return $head->val;
    }
}