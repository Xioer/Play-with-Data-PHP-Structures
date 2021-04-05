<?php

/**
 * 完全二叉树 - 堆
 * Class MaxHeap
 *
 */
class MaxHeap
{
    private $data = [];

    public function size(){return count($this->data);}

    public function isEmpty(){return count($this->data) == 0;}

    //返回完全二叉树的数组表示中，一个索引所表示的元素的父亲节点的索引
    public function parent($index)
    {
        if ($index == 0){
            echo "没有此值";
            return false;
        }
        return ($index - 1) / 2; 
    }

    //返回完全二叉树的数组表示中，一个索引所表示的元素的左节点的索引
    public function leftChild($index){return $index * 2 + 1;}

    //返回完全二叉树的数组表示中，一个索引所表示的元素的右节点的索引
    public function rightChile($index){return $index * 2 + 2;}

    /**
     * 添加元素
     * @param $e
     */
    public function add($e)
    {
        $this->data[] = $e;
        $this->siftUp($this->size() - 1);
    }

    /**
     * 上浮元素
     * @param $k
     */
    public function siftUp($k)
    {
        while ($k > 0 && $this->data[$this->parent($k)] < $this->data[$k]){
            $this->swap($k, $this->parent($k));
            $k = $this->parent($k);
        }
    }

    /**
     * 交换位置
     * @param $i
     * @param $j
     * @return false
     */
    public function swap($i, $j)
    {
        if ($i < 0 || $i >= $this->size() || $j < 0 || $j >= $this->size()){
            echo "索引错误";
            return false;
        }
        $t = $this->data[$i];
        $this->data[$i] = $this->data[$j];
        $this->data[$j] = $t;
    }

    //看堆中的最大元素
    public function findMax()
    {
        if ($this->size() == 0){
            echo "堆中没有元素";
            return false;
        }
        return $this->data[0];
    }

    //取出堆中最大的元素
    public function extractMax()
    {
        $ret = $this->findMax();
        $this->swap(0,$this->size() - 1);

        //删除最有一个元素
        unset($this->data[$this->size() - 1]);
        $this->siftDown(0);
        return $ret;
    }

    /**
     * 下沉元素
     * @param $k
     */
    public function siftDown($k)
    {
        while ($this->leftChild($k) < $this->size()){
            $j = $this->leftChild($k);
            if($j + 1 < $this->size() && $this->data[$j + 1] > $this->data[$j]){
                //data[j]是leftChild和rightChild中的最大值
                $j = $this->rightChile($k);
            }
            if ($this->data[$k] >= $this->data[$j]){
                break;
            }
            $this->swap($k,$j);
            $k = $j;
        }
    }

    //取出堆中的最大元素，并且替换成元素e
    public function replace($e)
    {
        $ret = $this->findMax($e);
        $this->data[0] = $e;
        $this->siftDown(0);
        return $ret;
    }

    /**
     * 数组转换堆
     * @param array $arr
     */
    public function Maxheapi($arr = [])
    {
        $this->data = $arr;
        for ($i = $this->parent($this->size() - 1); $i >= 0; $i--){
            $this->siftDown($i);
        }
    }


}