<?
include_once "SortHelper/SortHelper.php";
/**
 * 归并排序排序
 */
function mergeSort(&$arr)
{
    $arr_len = count($arr);
    if ($arr_len <= 0) {
        return [];
    }
    merge_sort($arr, 0, $arr_len - 1);
}
//递归调用对arr[l...r]的范围进行排序
function merge_sort(&$arr, $l, $r)
{
    // if ($l < $r) {
    //     $mid = intval(($l + $r) / 2);
    //     merge_sort($arr, $l, $mid);
    //     merge_sort($arr, $mid + 1, $r);
    //     mergeData($arr, $l, $mid,$r);        
    // }

    if ($l >= $r) {
        return;    
    }
    $mid = intval(($l + $r) / 2);
    merge_sort($arr, $l, $mid);
    merge_sort($arr, $mid + 1, $r);
    mergeData($arr, $l, $mid,$r);    
}
function mergeData(&$arr, $l, $mid,$r){

        //将数组arr[l...mid]和arr[mid + 1...r]两部分进行合并
        /**
         * 写法1：
         */
        // $temparr = [];
        // $i = $l;
        // $k = $l;
        // $j = $mid + 1;
        // while($i != $mid + 1 && $j != $r+1)
        // {
        //     if($arr[$i] >= $arr[$j]){
        //         $temparr[$k++] = $arr[$j++];
        //     }
        //     else{
        //         $temparr[$k++] = $arr[$i++];
        //     }
        // }

        // //将第一个子序列的剩余部分添加到已经排好序的 $temparr 数组中
        // while($i != $mid+1){
        //     $temparr[$k++] = $arr[$i++];
        // }
        // //将第二个子序列的剩余部分添加到已经排好序的 $temparr 数组中
        // while($j != $r+1){
        //     $temparr[$k++] = $arr[$j++];
        // }
        // for($i=$l; $i<=$r; $i++){
        //     $arr[$i] = $temparr[$i];
        // }


        /**
         * 写法2：
         */
        $aux = [];
        for ($i = $l; $i <= $r; $i++) { 
            $aux[$i - $l] = $arr[$i];
        }
        $i = $l;
        $j = $mid + 1;
        for ($k = $l; $k <= $r; $k++) { 

            if ($i > $mid) {
                $arr[$k] = $aux[$j - $l];
                $j++;
            }elseif($j > $r) {
                $arr[$k] = $aux[$i - $l];
                $i++;
            }elseif($aux[$i - $l] < $aux[$j - $l]) {
                $arr[$k] = $aux[$i - $l];
                $i++;
            }else{
                $arr[$k] = $aux[$j - $l];
                $j++;
            }
        }
}

$start = microtime();
$arr = SortHelper::generateRandomArray(2000,10,1000000);
// $arr = [100,4,5,6,7,2,44,59,67,57,45,71,82];
mergeSort($arr);
$endtime = microtime();
echo '排序耗时：'.($endtime - $start) .'毫秒'."\n";
// for ($i=0; $i < count($arr); $i++) { 
//     echo $arr[$i].', ';
// }

?>