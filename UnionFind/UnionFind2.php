<?php
/**
 * 并查集实现2
 */
include_once "UnionFind/UF.php";
class UnionFind2 implements UF{

    private $parent = [];
    public function __construct($size)
    {
        for ($i=0; $i < $size; $i++) { 
            $parent[$i] = $i;
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
        while ($p != $this->parent[$p]) {
            $p = $this->parent[$p];
        }
        return $p;
        
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
        $this->parent[$pRoot] = $qRoot;
    }



}