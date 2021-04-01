<?php
namespace ArrayInfo;
/**
 * 数组
 * Class ArrayBase
 */
class ArrayBase
{
    //初始化数组
    public $data = [];

    //数组大小
    public $size = 0;

    /**
     * 获取数组
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 获取数组大小
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * 获取数组的容量
     * @return int
     */
    public function getCapacity(){
        return count($this->data);
    }


    /**
     * 数组是否为空
     * @return bool
     */
    public function isEmpty()
    {
        return $this->size == 0;
    }


    /**
     * 向数组头部添加一个元素
     * @param $e
     */
    public function addFirst($e)
    {
        $this->add(0,$e);
    }

    /**
     * 向数组后面添加一个元素
     * @param $e
     */
    public function addLast($e)
    {
        $this->add($this->size, $e);
    }

    /**
     * 向数组指定位置插入元素
     * @param $index 待插入的位置
     * @param $e 待插入的值
     */
    public function add($index, $e)
    {
        if ($index < 0 || $index > $this->size){
            echo "待插入的数组索引错误";
            exit;
        }
        for ($i = $this->size - 1; $i >= $index; $i--) { 
            $this->data[$i+1] = $this->data[$i];
        }
        $this->data[$index] = $e;
        $this->size++;
    }

    /**
     * 获取数组的值
     * @param $index
     * @return mixed
     */
    public function get($index)
    {
        if($index <0 || $index > $this->getSize()){
            echo "数组索引错误";
        }
        return $this->data[$index];
    }

    /**
     * 获取数组最后一个值
     * @return mixed
     */
    public function getLast()
    {
        return $this->get($this->size - 1);
    }

    /**
     * 获取第一个值
     * @return mixed
     */
    public function getFirst()
    {
        $first = $this->data[0];
        unset($this->data[0]);
        return $first;
    }

    /**
     * 修改数组
     * @param $index
     * @param $e
     */
    public function set($index,$e)
    {
        if($index <0 || $index > $this->getSize()){
            echo "数组索引错误";
        }
        $this->data[$index] = $e;

    }

    /**
     * 查找某个元素是否在数组中
     * @param $e
     * @return bool
     */
    public function contains($e)
    {
        for ($i = 0; $i < $this->size; $i++){
            if($this->data[$i] == $e){
                return true;
            }
        }
        return  false;
    }

    /**
     * 查找某个元素是否在数组中 - 并返回对应的索引
     * @param $e
     * @return int
     */
    public function find($e)
    {
        for ($i = 0; $i < $this->size; $i++){
            if($this->data[$i] == $e){
                return $i;
            }
        }
        return -1;
    }

    /**
     * 移除某个元素
     * @param $index
     * @return mixed
     */
    public function remove($index)
    {
        if($index <0 || $index > $this->size){
            echo "数组索引错误";
        }
        $ret = $this->data[$index];
        for ($i = $index + 1;$i < $this->size; $i++){
            $this->data[$i - 1] = $this->data[$i];
        }
        $this->size--;
        unset($this->data[$this->size]);
        return $ret;
    }

    /**
     * 删除第一个数组元素
     * @return mixed
     */
    public function removeFirst()
    {
        return $this->remove(0);
    }

    /**
     * 删除数组最后一个元素
     * @return mixed
     */
    public function removeLast()
    {
        return $this->remove($this->size);
    }

    /**
     * 先判断是否有此值，有的话再进行删除
     * @param $e
     */
    public function removeElement($e)
    {
        $index = $this->find($e);
        if($index != -1){
            $this->remove($index);
        }
    }

    public function toString()
    {
        printf('Array：size=%d，capacity=%d',$this->getSize(),$this->getCapacity());
        echo "\n";
        $str = '[';
        for ($i = 0;$i < $this->getSize();$i++) {
            $str .= $this->getData()[$i];
            if($i != $this->getSize() - 1){
                $str .= ", ";
            }
        }
        $str .= ']';
        return $str;
    }
}



