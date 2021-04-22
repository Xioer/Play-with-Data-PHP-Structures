<?php
/**
 * 函数帮助文件
 */
class SortHelper{

//生成有n个元素的随机数组，每个元素的随机范围为【rangeL,rangeR】
    public static function generateRandomArray($n, $rangeL, $rangeR)
    {
        if ($rangeL < 1 || $rangeR < 1 || ($rangeL == $rangeR)) {
            return [];
        }
        if (intval($rangeL) > intval($rangeR)) {
            $temp = $rangeL;
            $rangeL = $rangeR;
            $rangeR = $temp;

        }
        $arr = [];
        for ($i=0; $i < $n; $i++) { 
            $arr[] = rand($rangeL,$rangeR);
        }
        return array_merge(array_unique($arr),[]);
    }
}
?>