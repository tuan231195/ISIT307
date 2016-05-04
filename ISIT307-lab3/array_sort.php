<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 26/03/2016
 * Time: 3:00 PM
 */

function array_sort(&$two_dimesional)
{
    $sumlist = array();
    $count = 0;
    if (is_array($two_dimesional)) {
        foreach ($two_dimesional as $subarray) {
            if (is_array($subarray)) {
                $sumlist[$count] = 0;
                foreach ($subarray as $element) {
                    $sumlist[$count] += $element;
                }
                $count++;
            } else {
                throw new exception("Invalid array");
            }

        }
        asort($sumlist);

        $tmp = array();
        foreach ($sumlist as $key => $value) {
            $tmp[] = $two_dimesional[$key];
        }
        $two_dimesional = $tmp;
    } else {
        throw new exception("Invalid array");
    }
}



$arr = array();
$arr[] = array(1,2,3,4);
$arr[] = array(50);
$arr[] = array(1);
$arr[] = array(9);
$arr[] = array(2);
echo "<pre>";
print_r($arr);
echo "</pre>";

array_sort($arr);

echo "<pre>";
print_r($arr);
echo "</pre>";