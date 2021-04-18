<?php
/**
 * 并查集实现1
 */
include_once "UnionFind/UF.php";
class UnionFind1 implements UF{
    private $id = [];

    public function __construct($size)
    {
        for ($i=0; $i < $size; $i++) { 
            $id[$i] = $i;
        }
    }

    public function getSize()
    {
        return count($this->id);
    }

    private function find($p)
    {
        if ($p < 0 && $p >= $this->getSize()) {
            echo "索引错误";
            return false;
        }
        return $this->id[$p];
    }

    public function isConnected($p,$q)
    {
        return $this->find($p) == $this->find($q);
    }

    public function unionElements($p,$q)
    {
        $pID = intval($this->find($p));
        $qID = intval($this->find($q));

        if ($pID == $qID) {
            return;
        }
        for ($i=0; $i < $this->getSize(); $i++) { 
            if ($this->id[$i] == $pID) {
                $this->id[$i] = $qID;
            }
        }
    }



}