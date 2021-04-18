<?php
/**
 * 使用二分搜索树
 */
class BSTMapNode
{

    public $key;
    public $value;
    public $left;
    public $right;
    public $height;

    public function __construct($key = null, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->right = null;
        $this->left = null;
        $this->height = 1;
    }
}

class BSTMapAvl
{
    private $root;
    private $size;

    public function __construct($root = null)
    {
        $this->root = $root;
        $this->size = 0;
    }

    /**
     * 获取高度
     */
    public function getHeight($node)
    {
        if (is_null($node) || !$node) {
            return 0;
        }
        return $node->height;
    }

    private function getBalanceFactor($node){
        if (!is_null($node)) {
            return $this->getHeight($node->left) - $this->getHeight($node->right);
        }
    }

    //判断该二叉树是否是一棵二分搜索树
    public function isBST()
    {
        $keys= [];
        $this->inOrderPri($this->root, $keys);
        for ($i=0; $i < count($keys); $i++) { 
            if ($keys[$i - 1] > $keys[$i]) {
                return false;
            }
        }
        return true;
    }

    private function inOrderPri($node, $keys = [])
    {
        if (is_null($node)) {
            return;
        }
        $this->inOrderPri($node->left, $keys);
        $keys[$node->key];
        $this->inOrderPri($node->right, $keys);
    }

    //判断是否是平衡二叉树
    public function isBalanced()
    {
        return $this->isBalancedPri($this->root);
    }

    private function isBalancedPri($node)
    {
        if (is_null($node)) {
            return true;
        }
        $balanceFactor = intval($this->getBalanceFactor($node));
        if (abs($balanceFactor)) {
            return false;
        }
        return $this->isBalancedPri($node->left) && $this->isBalancedPri($node->right);
    }

    /**
     * @param $k
     * @param $v
     */
    public function add($k, $v)
    {
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
        //更新height - 待优化（获取最大值）
        $node->height = max($this->getHeight($this->left), $this->getHeight($this->right)) + 1;

        //计算平衡因子
        $balacceFactor = intval($this->getBalanceFactor($node));
        // if (abs($balacceFactor) > 1) {
        //     echo "unbalanced：" . $balacceFactor."\n";
        // }

        //平衡维护
        //LL
        if ($balacceFactor > 1 && $this->getBalanceFactor($node->left) >= 0) {
            //右旋转
            return $this->rightRotate($node);
        }
        //RR
        if ($balacceFactor < -1 && $this->getBalanceFactor($node->right) <= 0) {
            //左旋转
            return $this->leftRotate($node);
        }

        //LR
        if ($balacceFactor > 1 && $this->getBalanceFactor($node->left) < 0) {
            $node->left = $this->leftRotate($node->left);
            return $this->rightRotate($node);
        }
        //RL
        if ($balacceFactor < -1 && $this->getBalanceFactor($node->right) > 0) {
            $node->right = $this->rightRotate($node->right);
            return $this->leftRotate($node);
        }

        return $node;
    }

    /**
     * 右旋转
     * 对节点Y进行向右旋转操作，返回旋转后新的根节点x
     */
    private function rightRotate($y)
    {
        $x = $y->left;
        $T3 = $x->right;

        //向右旋转过程
        $x->right = $y;
        $y->left = $T3;

        //更新height
        /**
         * @TODO max函数需要重写
         */
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;
        return $x;
    }

    /**
     * 左旋转
     * 对节点Y进行向左旋转操作，返回旋转后新的根节点x
     */
    private function leftRotate($y)
    {
        $x = $y->right;
        $T2 = $x->left;

        //向右旋转过程
        $x->left = $y;
        $y->right = $T2;

        //更新height
        /**
         * @TODO max函数需要重写
         */
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;
        return $x;
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

    /**
     * 删除节点
     */
    public function remove($k)
    {
        $node = $this->getNode($this->root,$k);
        if(!is_null($node)){
            $this->root = $this->removePri($this->root,$k);
            return $node->value;
        }
        return null;
    }
    private function removePri($node, $k)
    {

        if(is_null($node)){
            return null;
        }

        $retNode = '';

        if($k < $node->key){
            $node->left = $this->removePri($node->left, $k);
            $retNode = $node;
        }elseif($k > $node->key){
            $node->right = $this->removePri($node->right, $k);
            $retNode = $node;
        }else{
            //待删除节点左子树为空的情况
            if(is_null($node->left)){
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                $retNode = $rightNode;
            }elseif(is_null($node->right)){
                //待删除节点右子树为空的情况
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;
                $retNode = $leftNode;
            }else {
                
                //待删除的左右子树均不为空的情况
                //找到比待删除节点大的最小节点，即待删除节点右子树的最小节点
                //用这个节点顶替待删除的节点的位置
                $successor = $this->minNumFind($node->right);//找到右子树最小的节点
                $successor->right = $this->removePri($node->right, $successor->key);//删除右子树最小的节点
                $successor->left = $node->left;//用这个节点顶替待删除的节点的位置
                $node->left = $node->right = null;
                $retNode = $successor;
            }
        }

        if (is_null($retNode)) {
            return null;
        }

        //更新height - 待优化（获取最大值）
        $retNode->height = max($this->getHeight($retNode->left), $this->getHeight($retNode->right)) + 1;

        //计算平衡因子
        $balacceFactor = intval($this->getBalanceFactor($retNode));

        //平衡维护
        //LL
        if ($balacceFactor > 1 && $this->getBalanceFactor($retNode->left) >= 0) {
            //右旋转
            return $this->rightRotate($retNode);
        }
        //RR
        if ($balacceFactor < -1 && $this->getBalanceFactor($retNode->right) <= 0) {
            //左旋转
            return $this->leftRotate($retNode);
        }

        //LR
        if ($balacceFactor > 1 && $this->getBalanceFactor($retNode->left) < 0) {
            $retNode->left = $this->leftRotate($retNode->left);
            return $this->rightRotate($retNode);
        }
        //RL
        if ($balacceFactor < -1 && $this->getBalanceFactor($retNode->right) > 0) {
            $retNode->right = $this->rightRotate($retNode->right);
            return $this->leftRotate($retNode);
        }

        return $retNode;
    }
    /**
     * 从二分搜索树当中删除最小值所在的节点，返回最小值节点
     * 递归算法
     * @param $node
     * @return mixed
     */
    // private function removeMinPri($node)
    // {
    //     if (is_null($node->left)){
    //         $rightNode = $node->right;
    //         $node->right = null;
    //         $this->size--;
    //         return $rightNode;
    //     }
    //     $node->left = $this->removeMinPri($node->left);
    //     return $node;
    // }

    public function contains($k)
    {
        // TODO: Implement contains() method.
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