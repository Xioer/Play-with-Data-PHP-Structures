<?php

/**
 * 线段树
 * Class SegmentTree
 */
class SegmentTree
{
    //定义线段树
    private $tree = [];
    //初始化数组 - 为了后面转换线段树
    private $data;

    public function __construct($arr = []){
        $this->data = $arr;
        $this->buildSegmentTree(0,0,count($this->data) - 1);
    }

    //在treeIndex的位置创建表示区间[l...r]的线段树
    private function buildSegmentTree($treeIndex, $l, $r)
    {
        if ($l == $r){
            $this->tree[$treeIndex] = $this->data[$l];
            return;
        }
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        //mid只能是整数，数组里面小数的索引没有
        $mid = intval($l + ($r - $l) / 2);
        $this->buildSegmentTree($leftTreeIndex,$l,$mid);
        $this->buildSegmentTree($rightTreeIndex,$mid + 1, $r);

        $this->tree[$treeIndex] = $this->tree[$leftTreeIndex] + $this->tree[$rightTreeIndex];
    }

    //区间查询
    public function query($queryL, $queryR)
    {
        if ($queryL < 0 || $queryR >= $this->getSize()){
            echo "索引出错";
            return false;
        }
        return $this->queryDG(0,0,count($this->data) - 1, $queryL, $queryR);
    }

    /**
     * 递归调用
     * 在以treeID为根的线段树中[l...r]的范围里，搜索区间[$queryL...$queryR]的值
     * @param $treeIndex
     * @param $l
     * @param $r
     * @param $queryL
     * @param $queryR
     * @return integer
     */
    private function queryDG($treeIndex, $l, $r, $queryL, $queryR)
    {
        if ($l == $queryL && $r == $queryR){
            return $this->tree[$treeIndex];
        }
        $mid = intval($l + ($r - $l) / 2);
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        if ($queryL >= $mid + 1){
            return $this->queryDG($rightTreeIndex, $mid + 1, $r,$queryL,$queryR);
        }elseif ($queryR <= $mid){
            return $this->queryDG($leftTreeIndex,$l,$mid,$queryL,$queryR);
        }
        $leftResult = $this->queryDG($leftTreeIndex,$l,$mid,$queryL,$mid);
        $rightResult = $this->queryDG($rightTreeIndex,$mid + 1,$r,$mid + 1,$queryR);
        return $leftResult + $rightResult;
    }

    //把index位置的值更新为e O(logN)
    public function set($index,$e)
    {
        if ($index < 0 || $index > count($this->data)){
            echo "索引错误";
            return false;
        }
        $this->data[$index] = $e;
        $this->setPri(0, 0, count($this->data) - 1, $index, $e);
    }

    //在以treeIndex为根的线段树中更新index的值为e
    private function setPri($treeIndex, $l, $r, $index,$e)
    {
        if ($l == $r){
            $this->tree[$index] = $e;
            return;
        }
        $mid = $l + ($r - $l) / 2;
        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);
        if ($index >= $mid + 1){
            $this->setPri($rightTreeIndex, $mid +1,$r,$index,$e);
        }else{
            $this->setPri($leftTreeIndex,$l,$mid,$index,$e);
        }
        $this->tree[$index] = $this->tree[$leftTreeIndex] + $this->tree[$rightTreeIndex];


    }

    public function getSize()
    {
        return count($this->data);
    }

    /**
     * 查询 O(logN)
     * @param $index
     * @return false|mixed
     */
    public function get($index)
    {
        if($index < 0 || $index >= $this->getSize()){
            echo "索引出错";
            return false;
        }
        return $this->data[$index];
    }

    //返回完全二叉树的数组表示中，一个索引所表示的元素的左孩子节点的索引
    public function leftChild($index)
    {
        return 2 * $index + 1;
    }

    //返回完全二叉树的数组表示中，一个索引所表示的元素的右孩子节点的索引
    public function rightChild($index)
    {
        return 2 * $index + 2;
    }

    public function toString()
    {
        $len = count($this->tree) * 4;
        $str = '[';
        for ($i = 0; $i < $len; $i++){
            if (!is_null($this->tree[$i])){
                $str .= $this->tree[$i];
            }else{
                $str .= 'null';
            }
            if ($i != $len - 1){
                $str .= ', ';
            }
        }
        $str .= ']';
        return $str;
    }

}