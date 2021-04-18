<?php
/**
 * 并查集实现6
 */
include_once "UnionFind/UF.php";
class UnionFind6 implements UF{

    private $parent = [];
    //rank[i]表示以i为根的集合所表示的树的层数
    private $rank = [];
    public function __construct($size)
    {
        for ($i=0; $i < $size; $i++) { 
            $parent[$i] = $i;
            $rank[$i] = 1;
        }
    }

    public function getSize()
    {
        return count($this->parent);
    }

    private function find($p)
    {
        if ($p < 0 && $p >= $this->getSize()) {
            echo "索引错误";
            return false;
        }
        if($p != $this->parent[$p]) {
            //添加路径压缩 - 递归实现
            $this->parent[$p] = $this->find[$this->parent[$p]];
        }
        return $this->parent[$p];
    }

    public function isConnected($p,$q)
    {
        return $this->find($p) == $this->find($q);
    }

    public function unionElements($p,$q)
    {
        $pRoot = intval($this->find($p));
        $qRoot = intval($this->find($q));

        if ($pRoot == $qRoot) {
            return;
        }

        //根据两个元素所在树的rank不同判断合并方向
        //将rank低的集合合并到rank高的集合上
        if ($this->rank[$pRoot] < $this->rank[$qRoot]) {
            $this->parent[$pRoot] = $qRoot;
        }elseif($this->rank[$qRoot] < $this->rank[$pRoot]){
            $this->parent[$qRoot] = $pRoot;
        }else {
            $this->parent[$qRoot] = $pRoot;
            $this->parent[$pRoot] += 1;
        }

    }


}