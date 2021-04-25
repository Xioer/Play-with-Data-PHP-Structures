<?
include_once "SortHelper/SortHelper.php";
/**
 * 选择排序
 */
//整型
// $sortarr = [100,4,5,6,7,2,44,59,67,57,45,71,82];

//浮点型
// $arr = [100.5,4.2,4.3,5,1,6.5,7,2.8,2.9,44,59,67,57,45,71,82];

//字符串
// $arr = ['D','G','Z','B','A'];


function selectSort($arr)
{
    $arr_len = count($arr);
    if ($arr_len <= 0) {
        return [];
    }

    for ($i=0; $i < $arr_len; $i++) { 

        $index = $i;

        for ($j = $i + 1; $j < $arr_len; $j++) { 

            //如果后面的数 < 前面的数 两个数就交换位置
            if ($arr[$j] < $arr[$index]) {//这里比较可以自定义函数来兼容数组排序
                //把要交换的后面的数先用临时变量存储
                $temp = $arr[$j];

                //把前面的数赋值给后面的数
                $arr[$j] = $arr[$i];

                //把后面的数赋值给前面的数
                $arr[$i] = $temp;

                //然后循环
            }
        }
        
    }
    return $arr;
}
$sortarr = SortHelper::generateRandomArray(1000,100,500000);
$sort_arr = selectSort($sortarr);

?>