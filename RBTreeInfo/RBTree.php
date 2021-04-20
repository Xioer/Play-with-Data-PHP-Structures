<?php
/**
 * 红黑树
 */
class RBTreeNode
{

    private static $RED = true;
    private static $BLACK = false;
    
    public $key;
    public $value;
    public $left;
    public $right;
    public $color;

    public function __construct($key = null, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->right = null;
        $this->left = null;
        $this->color = self::$RED;//true
    }
}

class RBTree
{
    private static $RED = true;
    private static $BLACK = false;
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
        $this->root = $this->addE($this->root,$k,$v);
        $this->root->color = self::$BLACK;
    }

    //判断节点是否是红节点
    private function isRed($node)
    {
        if (is_null($node)) {
            return self::$BLACK;
        }
        return $node->color;
    }

    //左旋转
    private function leftRotate($node)
    {
        $x = $node->right;

        //坐旋转
        $node->right = $x->left;
        $x->left = $node;

        $x->color = $node->color;
        $node->color = self::$RED;

        return $x;
    }

    //右旋转
    private function rightRotate($node)
    {
        $x = $node->left;

        //坐旋转
        $node->left = $x->right;
        $x->right = $node;

        $x->color = $node->color;
        $node->color = self::$RED;

        return $x;
    }

    //颜色翻转
    private function flipColors($node)
    {
        $node->color = self::$RED;
        $node->left->color = self::$BLACK;
        $node->right->color = self::$BLACK;

    }


    /**
     * 向以node为根的红黑树中插入元素key,value,递归算法
     * 返回插入新节点后红黑树的根
     * @param $node
     * @param $k
     * @param $v
     * @return RBTreeNode
     */
    private function addE($node, $k, $v)
    {
        //递归终止条件
        if(is_null($node)){
            $this->size++;
            return new RBTreeNode($k,$v);
        }

        //递归调用
        if($k < $node->key){
            $node->left = $this->addE($node->left,$k,$v);
        }elseif($k > $node->key){
            $node->right = $this->addE($node->right,$k,$v);
        }else{
            $node->value = $v;
        }

        if ($this->isRed($node->right) && !$this->isRed($node->left)) {
            $node = $this->leftRotate($node);
        }
        if ($this->isRed($node->left) && $this->isRed($node->left->left)) {
            $node = $this->rightRotate($node);
        }
        if ($this->isRed($node->left) && $this->isRed($node->right)) {
            $this->flipColors($node);
        }
        

        return $node;
    }

    //删除元素
    public function remove($k)
    {
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
        return $this->getNode($this->root,$k);
    }

    public function get($k)
    {
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
        $node = $this->getNode($this->root,$k);
        if (is_null($node)){
            echo "没有此key";
            return false;
        }
        $node->value = $v;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }
}