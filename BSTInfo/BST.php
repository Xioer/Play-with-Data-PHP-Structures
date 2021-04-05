<?php
/**
 * 二分搜索树 - 节点类
 * Class BST
 */
class BSTNode
{

    public $e;
    public $left;
    public $right;

    public function __construct($e = null)
    {
        $this->e = $e;
        $this->right = null;
        $this->left = null;
    }
}

/**
 * 二分搜索数实现类
 * Class BST
 */
class BST
{
    private $root;
    private $size;

    public function __construct($root = null)
    {
        $this->root = $root;
        $this->size = 0;
    }

    /**
     * 判断二分搜索树是否为空
     * @return bool
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }

    /**
     * 获取二分搜索树的大小
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * 向二分搜索树当中添加元素
     * @param $e
     */
    public function add($e)
    {
        $this->root = $this->addE($this->root,$e);
    }

    /**
     * 向以node为根的二分搜索数中插入元素e,递归算法
     * 返回插入新节点后二分搜索数的根
     * @param $node
     * @param $e
     */
    private function addE($node, $e)
    {
        //递归终止条件
        if(is_null($node)){
            $this->size++;
            return new BSTNode($e);
        }

        //递归调用
        if($e < $node->e){
            $node->left = $this->addE($node->left,$e);
        }elseif($e > $node->e){
            $node->right = $this->addE($node->right,$e);
        }
        return $node;
    }

    /**
     * 查看二分搜索树中是否包含元素
     * @param $e
     * @return bool
     */
    public function contains($e)
    {
        return $this->containsRoot($this->root,$e);
    }

    /**
     *
     * 查看以node为根的二分搜索树中是否包含元素e,递归算法
     * @param $node
     * @param $e
     */
    private function containsRoot($node, $e)
    {
        if(is_null($node)){
            return false;
        }
        if($e == $node->e){
            return  true;
        }elseif($e < $node->e){
            return $this->containsRoot($node->left,$e);
        }else{
            return $this->containsRoot($node->right,$e);
        }
    }

    //二分搜索数的前序遍历
    public function preOrder()
    {
        $this->preOrderNode($this->root);
    }

    /**
     * 前序遍历以node为根的二分搜索树，递归算法
     * @param $node
     */
    private function preOrderNode($node)
    {
        if(is_null($node)){
            return;
        }
        echo $node->e."\n";
        $this->preOrderNode($node->left);
        $this->preOrderNode($node->right);
    }

    /**
     * 前序遍历非递归实现
     */
    public function preOrderNotNode()
    {
        //使用php的数组直接搞定
        $stack = [];
        array_push($stack,$this->root);
        while (!empty($stack)){
            $cur = array_pop($stack);
            echo $cur->e."ln";

            if(!empty($cur->right)){
                array_push($stack,$cur->left);
            }
            if(!empty($cur->left)){
                array_push($stack,$cur->left);
            }
        }
    }

    /**
     * 二分搜索树的层序遍历
     */
    public function levelOrder()
    {
        //使用php的数组直接搞定
        $queue = [];
        array_push($queue,$this->root);
        while (!empty($queue)){
            $cur = array_pop($queue);
            echo $cur->e."\n";

            if(!empty($cur->left)){
                array_push($queue,$cur->left);
            }
            if(!empty($cur->right)){
                array_push($queue,$cur->right);
            }
        }

    }

    //二分搜索数的中序遍历
    public function inOrder()
    {
        $this->inOrderNode($this->root);
    }

    /**
     * 中序遍历以node为根的二分搜索树，递归算法
     * @param $node
     */
    private function inOrderNode($node)
    {
        if(is_null($node)){
            return;
        }
        $this->inOrderNode($node->left);
        echo $node->e."\n";
        $this->inOrderNode($node->right);
    }

    //二分搜索树的后序遍历
    public function postOrder()
    {
        $this->postOrderNode($this->root);
    }

    /**
     * 后序遍历以node为根的二分搜索树，递归算法
     * @param $node
     */
    private function postOrderNode($node)
    {
        if(is_null($node)){
            return;
        }
        $this->postOrderNode($node->left);
        $this->postOrderNode($node->right);
        echo $node->e."\n";
    }

    //查找二分搜索树的最小值
    public function minNum()
    {
        if($this->size == 0){
            echo "没有元素";
            return false;
        }
        return $this->minNumFind($this->root)->e;
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

    //查找二分搜索树的最大值
    public function maxNum()
    {
        if($this->size == 0){
            echo "没有元素";
            return false;
        }
        return $this->maxNumFind($this->root)->e;
    }

    /**
     * 返回以node为根的二分搜索树的最大值所在的节点
     * @param $node
     * @return mixed
     */
    private function maxNumFind($node)
    {
        if (is_null($node->right)){
            return $node;
        }
        return $this->maxNumFind($node->right);
    }

    //从二分搜索树当中删除最小值所在的节点，返回最小值
    public function removeMin()
    {
        $ret = $this->minNum();
        $this->root = $this->removeMinPri($this->root);
        return $ret;
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

    //从二分搜索树当中删除最大值所在的节点，返回最大值
    public function removeMax()
    {
        $ret = $this->maxNum();
        $this->root = $this->removeMaxPri($this->root);
        return $ret;
    }

    /**
     * 从二分搜索树当中删除最小值所在的节点，返回最小值
     * 递归算法
     * @param $node
     * @return mixed
     */
    private function removeMaxPri($node)
    {
        if (is_null($node->right)){
            $rightNode = $node->left;
            $node->left = null;
            $this->size--;
            return $rightNode;
        }
        $node->right = $this->removeMinPri($node->right);
        return $node;
    }

    /**
     * 删除二分搜索树任意元素
     * @param $e
     */
    public function remove($e)
    {
        $this->root = $this->removePri($this->root,$e);
    }

    private function removePri($node, $e)
    {

        if(is_null($node)){
            return null;
        }
        if($e < $node->e){
            $node->left = $this->removePri($node->left, $e);
            return $node;
        }elseif($e > $node->e){
            $node->right = $this->removePri($node->right, $e);
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

}