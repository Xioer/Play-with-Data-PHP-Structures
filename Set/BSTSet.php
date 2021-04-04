<?php
include "Set/BST.php";
include "SetInfo.php";

class BSTSet implements SetInfo
{
    public $bst;
    public function __construct()
    {
        $this->bst= new BST();
    }

    /**
     * @param $e O(LogN) - 默认平均情况下
     */
    public function add($e)
    {
        // TODO: Implement add() method.
        $this->bst->add($e);
    }

    /**
     * @param $e O(LogN)
     */
    public function remove($e)
    {
        // TODO: Implement remove() method.
        $this->bst->remove($e);
    }

    /**
     * @param $e O(LogN)
     * @return bool
     */
    public function contains($e)
    {
        // TODO: Implement contains() method.
        return $this->bst->contains($e);
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->bst->getSize();
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->bst->isEmpty();
    }
}