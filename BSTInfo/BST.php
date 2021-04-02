<?php

/**
 * 二分搜索树 - 节点类
 * Class BST
 */
class Node
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
}