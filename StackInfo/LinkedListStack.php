<?php
//include "Stack.php";
include "StackInfo/Stack.php";
include "LinkedInfo/LinkedList.php";


class LinkedListStack implements \ArrayStackInfo\Stack
{

    private $list;
    public function __construct()
    {
        $this->list = new \LinkInfo\LinkedList();
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->list->getSize();
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->list->isEmpty();
    }

    public function push($e)
    {
        // TODO: Implement push() method.
        $this->list->addFirst($e);
    }

    public function pop()
    {
        // TODO: Implement pop() method.
        return $this->list->removeFirst();
    }

    public function peek()
    {
        // TODO: Implement peek() method.
        return $this->list->getFirst();
    }

    /**
     * @return string
     */
    public function toString()
    {
        return 'Stack:top '. $this->list->toString();
    }
}