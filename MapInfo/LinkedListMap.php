<?php
/**
 * 使用链表实现的Map
 */
include "Map.php";
class MapNode
{

    public $key;
    public $value;
    public $next;

    public function __construct($key = null, $value = null, $next = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }
}

class LinkedListMap implements Map
{

    private $dummyHead;
    private $size;

    public function __construct()
    {
        $this->dummyHead = new MapNode();
        $this->size = 0;
    }

    private function getNode($key)
    {
        $cur = $this->dummyHead->next;
        while (!is_null($cur)){
            if($cur->key == $key){
                return $cur;
            }
            $cur = $cur->next;
        }
        return  null;
    }

    public function add($k, $v)
    {
        // TODO: Implement add() method.
        $node = $this->getNode($k);
        if(is_null($node)){
            $this->dummyHead->next = new MapNode($k,$v,$this->dummyHead->next);
            $this->size++;
        }else{
            $node->value = $v;
        }
    }

    public function remove($k)
    {
        // TODO: Implement remove() method.
        $prev = $this->dummyHead;
        while (!is_null($prev->next)){
            if($prev->next->key == $k){
                break;
            }else{
                $prev = $prev->next;
            }
        }
        if(is_null($prev->next)){
            $retNode = $prev->next;
            $prev->next = $retNode->next;
            $retNode->next = null;
            $this->size--;
            return $retNode->value;
        }
        return null;
    }

    public function contains($k)
    {
        // TODO: Implement contains() method.
        return is_null($this->getNode($k));
    }

    public function get($k)
    {
        // TODO: Implement get() method.
        $node = $this->getNode($k);
        return $node == null ? null : $node->value;
    }

    public function set($k, $v)
    {
        // TODO: Implement set() method.
        $node = $this->getNode($k);
        if(is_null($node)){
            echo "没有此节点";
            return false;
        }
        $node->value = $v;
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return $this->size;
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
        return $this->size == 0;
    }
}