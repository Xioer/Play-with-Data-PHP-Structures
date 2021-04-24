<?
include_once "SortHelper/SortHelper.php";
/**
 * 快速排序 2 双路快速排序
 */

/**
 * 3、对arr[l...r]部分进行partition操作
 * 返回P,使得arr[l...p-1] < arr[p]; arr[p+1...r] > arr[p]
 */
function _partition(&$arr, $l, $r)
{

    //随机一个数
    $rand_index = rand() % ($r - $l + 1) + $l;
    $tem = $arr[$l];
    $arr[$l] = $arr[$rand_index];
    $arr[$rand_index] = $tem;

    //使用最左侧的元素
    $v = $arr[$l];

    //arr[l+1...i) <= v; arr(j...r]) >= v
    $i = $l + 1;
    $j = $r;
    while (true) {
        while ($i <= $r && $arr[$i] < $v ) {
            $i++;
        }
        while ($j >= $l + 1 && $arr[$j] > $v ) {
            $j--;
        }
        if ($i > $j) {
            break;
        }
        $temp = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $temp;
        $i++;
        $j--;
    }
    $temp = $arr[$l];
    $arr[$l] = $arr[$j];
    $arr[$j] = $temp;

    return $j;
}

//2、递归调用对arr[l...r]的范围进行排序
function quick_sort(&$arr, $l, $r)
{
    if ($l >= $r) {
        return;    
    }

    $p = _partition($arr, $l, $r);
    quick_sort($arr, $l, $p - 1);
    quick_sort($arr, $p + 1, $r);
}

//快速排序 1、主方法
function quickSort(&$arr)
{
    $arr_len = count($arr);
    if ($arr_len <= 0) {
        return [];
    }
    quick_sort($arr, 0, $arr_len - 1);
}

$start = microtime();
$arr = SortHelper::generateRandomArray(200000,10,10000000);
// $arr = [100,4,5,6,7,2,44,59,67,57,45,71,82];
quickSort($arr);
$endtime = microtime();
echo '排序耗时：'.($endtime - $start) .'毫秒'."\n";
// print_r($arr);
// for ($i=0; $i < count($arr); $i++) { 
//     echo $arr[$i].', ';
// }

?>