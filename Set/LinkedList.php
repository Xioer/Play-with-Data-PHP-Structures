<?php
/**
 * 节点Node类
 * Class Node
 */
class LinkedNode
{

    public $e;
    public $next;

    public function __construct($e = null, $next = null)
    {
        $this->e = $e;
        $this->next = $next;
    }
}

/**
 * 链表类 - 带虚拟头节点的链表
 * 增删查 - 只查链表头的情况下 O(1)
 * Class LinkedList
 */
class LinkedList
{
    //虚拟头节点
    private $dummyHead;
    public $size;

    public function __construct()
    {
        $this->size = 0;
        $this->dummyHead = new LinkedNode();
    }

    public function getSize(){return $this->size;}

    public function isEmpty(){ return $this->size == 0; }


    /**
     * 在链表的index（0-based）位置添加新的元素e O(n)
     * @param $index
     * @param $e
     */
    public function add($index, $e)
    {
        if($index <0 || $index > $this->size){
            echo "索引错误";
        }

        //头节点
        $prev = $this->dummyHead;
        for ($i = 0; $i < $index; $i++){
            $prev = $prev->next;
        }
        $prev->next = new LinkedNode($e, $prev->next);
        $this->size++;
    }

    /**
     * 在链表头添加元素 O(1)
     * @param $e
     */
    public function addFirst($e){$this->add(0,$e);}

    /**
     * 在链表尾部添加元素 O(n)
     * @param $e
     */
    public function addLast($e){$this->add($this->size,$e);}

    /**
     * 获取第index位置的元素 O(n)
     * @param $index
     * @return mixed
     */
    public function get($index)
    {
        if($index < 0 || $index >= $this->size){
            echo "索引错误";
        }
        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++){
            $cur = $cur->next;
        }
        return $cur->e;
    }

    /**
     * 获取倒数第n个元素
     * @param $head
     * @param $val
     * @return mixed
     */
    public function getReciprocalVal($head, $val)
    {
        if($val < 0 || $val > $this->size){
            echo "索引错误";
        }
        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $this->size - $val; $i++){
            $cur = $cur->next;
        }
        return $cur->e;
    }

    /**
     * 获取第一个元素  O(1)
     * @return mixed
     */
    public function getFirst(){return $this->get(0);}

    /**
     * 获取最后一个元素 O(n)
     * @return mixed
     */
    public function getLast(){return $this->get($this->size - 1);}

    /**
     * 修改在指定位置的元素 O(n)
     * @param $index
     * @param $e
     */
    public function set($index, $e)
    {
        if($index < 0 || $index > $this->size){
            echo "索引错误";
        }
        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++){
            $cur = $cur->next;
        }
        $cur->e = $e;
    }

    /**
     * 查找链表中是否有元素$e O(n)
     * @param $e
     * @return bool
     */
    public function contains($e)
    {
        $cur = $this->dummyHead->next;
        while (!is_null($cur)){
            if($cur->e == $e){
                return true;
            }
            $cur = $cur->next;
        }
        return false;
    }


    /**
     * 删除指定位置元素 O(n)
     * @param $index
     * @return mixed
     */
    public function remove($index)
    {
        if($index < 0 || $index >= $this->size){
            echo "索引错误";
        }
        $prev = $this->dummyHead;
        for ($i = 0; $i < $index; $i++){
            $prev = $prev->next;
        }

        $retNode = $prev->next;
        $prev->next = $retNode->next;
        $retNode->next = null;

        $this->size--;
        return $retNode->e;
    }

    /**
     * 删除匹配到的所有元素
     * @param $val
     * @return mixed
     */
    public function removeVal($val)
    {
        $prev = $this->dummyHead;
        while (!is_null($prev->next)){
            if($prev->next->e == $val){
                $prev->next = $prev->next->next;
            }else{
                $prev = $prev->next;
            }
        }
        return $prev->next;
    }

    /**
     * 使用递归删除匹配到的所有元素
     * @param $head - 带虚拟节点的链表
     * @param $val
     * @return mixed|null
     */
    public function removeRecursionVal($head, $val)
    {
        if(is_null($head)){
            return null;
        }
        $head->next = $this->removeRecursionVal($head->next, $val);
        return $head->e == $val ? $head->next : $head;
    }

    /**
     * 获取头节点后面的节点
     * @param $head
     * @return mixed
     */
    public function getDummyHeadLinked($head)
    {
        return $head->dummyHead;
    }

    /**
     * 删除第一个元素  O(1)
     * @return mixed
     */
    public function removeFirst()
    {
        return $this->remove(0);
    }

    /**
     * 删除最后一个元素 O(n)
     * @return mixed
     */
    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    /**
     * 测试用
     * @return string
     */
    public function toString()
    {
        $str = 'Linked:';
        $cur = $this->dummyHead->next;
        while (!is_null($cur)){
            $str .= $cur->e . '->';
            $cur = $cur->next;
        }
        $str .= 'null';
        return $str;
    }

}

