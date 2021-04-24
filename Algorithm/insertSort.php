<?
include_once "SortHelper/SortHelper.php";
/**
 * 插入排序
 */
//整型
// $sortarr = [100,4,5,6,7,2,44,59,67,57,45,71,82];

//浮点型
// $arr = [100.5,4.2,4.3,5,1,6.5,7,2.8,2.9,44,59,67,57,45,71,82];

//字符串
// $arr = ['D','G','Z','B','A'];


function insertSort($arr)
{
    $arr_len = count($arr);
    if ($arr_len <= 0) {
        return [];
    }

    for ($i = 0; $i < $arr_len; $i++) { 

        //默认第一个已经排序好了
        $value = $arr[$i];

        /**
         * 写法1:
         */
        // for ($j = $i; $j > 0; $j--) { 
        //     //如果前面的数 > 后面的数 就把前面的数覆盖到后面
        //     if ($arr[$j - 1] > $value) {
        //         //把前面的数赋值给后面的数
        //         $arr[$j] = $arr[$j - 1];
        //         $arr[$j - 1] = $value;
        //     }else{
        //         break;
        //     }
        // }

        /**
         * 写法2：
         */
        //如果前面的数 > 后面的数 就把前面的数覆盖到后面
        for ($j = $i; $j > 0 && $arr[$j - 1] > $value; $j--) { 
            //把前面的数循环赋值给后面的数
            $arr[$j] = $arr[$j - 1];
        }
        //全部赋值完以后，再把值给到最后一个索引的位置
        $arr[$j] = $value;
    }
    return $arr;
}
$start = microtime(true);
$sortarr = SortHelper::generateRandomArray(10,100,500);
$sort_arr = insertSort($sortarr);
$endtime = microtime(true);
echo '排序耗时：'.($endtime - $start).'毫秒'."\n";
print_r($sort_arr);
?>