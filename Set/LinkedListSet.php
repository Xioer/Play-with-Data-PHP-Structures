<?php
include "Set/LinkedList.php";
include "SetInfo.php";

class LinkedListSet implements SetInfo
{

    public $bst;
    public function __construct()
    {
        $this->bst= new LinkedList();
    }

    /**
     * @param $e O(n)
     */
    public function add($e)
    {
        // TODO: Implement add() method.
        if(!$this->bst->contains($e)){
            $this->bst->addFirst($e);
        }
    }

    /**
     * @param $e O(n)
     */
    public function remove($e)
    {
        // TODO: Implement remove() method.
        $this->bst->remove($e);
    }

    /**
     * @param $e O(n)
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