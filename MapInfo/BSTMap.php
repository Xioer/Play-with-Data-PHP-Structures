<?php
/**
 * 使用二分搜索树实现的Map
 */
include "Map.php";
class BSTMapNode
{

    public $key;
    public $value;
    public $left;
    public $right;

    public function __construct($key = null, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->right = null;
        $this->left = null;
    }
}

class BSTMap implements Map
{
    private $root;
    private $size;

    public function __construct($root = null)
    {
        $this->root = $root;
        $this->size = 0;
    }

    /**
     * @param $k
     * @param $v
     */
    public function add($k, $v)
    {
        // TODO: Implement add() method.
        $this->root = $this->addE($this->root,$k,$v);
    }

    /**
     * 向以node为根的二分搜索数中插入元素key,value,递归算法
     * 返回插入新节点后二分搜索数的根
     * @param $node
     * @param $k
     * @param $v
     * @return BSTMapNode
     */
    private function addE($node, $k, $v)
    {
        //递归终止条件
        if(is_null($node)){
            $this->size++;
            return new BSTMapNode($k,$v);
        }

        //递归调用
        if($k < $node->key){
            $node->left = $this->addE($node->left,$k,$v);
        }elseif($k > $node->key){
            $node->right = $this->addE($node->right,$k,$v);
        }else{
            $node->value = $v;
        }
        return $node;
    }

    public function remove($k)
    {
        // TODO: Implement remove() method.
        $node = $this->getNode($this->root,$k);
        if(!is_null($node)){
            $this->root = $this->removePri($this->root,$k);
            return $node->value;
        }
        return null;
    }

    /**
     * 返回以node为根的二分搜索树的最小值所在的节点
     * @param $node
     * @return mixed
     */
    private function minNumFind($node)
    {
        if (is_null($node->left)){
            return $node;
        }
        return $this->minNumFind($node->left);
    }

    private function removePri($node, $k)
    {

        if(is_null($node)){
            return null;
        }
        if($k < $node->key){
            $node->left = $this->removePri($node->left, $k);
            return $node;
        }elseif($k > $node->key){
            $node->right = $this->removePri($node->right, $k);
            return $node;
        }else{
            //$e == $node->e
            //待删除节点左子树为空的情况
            if(is_null($node->left)){
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                return $rightNode;
            }
            //待删除节点右子树为空的情况
            if(is_null($node->right)){
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;
                return $leftNode;
            }

            //待删除的左右子树均不为空的情况
            //找到比待删除节点大的最小节点，即待删除节点右子树的最小节点
            //用这个节点顶替待删除的节点的位置
            $successor = $this->minNumFind($node->right);//找到右子树最小的节点
            $successor->right = $this->removeMinPri($node->right);//删除右子树最小的节点
            $successor->left = $node->left;//用这个节点顶替待删除的节点的位置
            $node->left = $node->right = null;
            return  $successor;
        }
    }
    /**
     * 从二分搜索树当中删除最小值所在的节点，返回最小值节点
     * 递归算法
     * @param $node
     * @return mixed
     */
    private function removeMinPri($node)
    {
        if (is_null($node->left)){
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;
            return $rightNode;
        }
        $node->left = $this->removeMinPri($node->left);
        return $node;
    }

    public function contains($k)
    {
        // TODO: Implement contains() method.
        return $this->getNode($this->root,$k);
    }

    public function get($k)
    {
        // TODO: Implement get() method.
        $node = $this->getNode($this->root,$k);
        return is_null($node) ? null : $node->value;
    }

    private function getNode($node, $k)
    {
        if (is_null($node)){
            return null;
        }
        if($k == $node->key){
            return $node;
        }elseif ($k < $node->key){
            return $this->getNode($node->left,$k);
        }else{
            return  $this->getNode($node->right,$k);
        }
    }

    public function set($k, $v)
    {
        // TODO: Implement set() method.
        $node = $this->getNode($this->root,$k);
        if (is_null($node)){
            echo "没有此key";
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