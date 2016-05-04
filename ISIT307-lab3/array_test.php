<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 26/03/2016
 * Time: 11:43 AM
 */

//hit 1
$array1 = array();


$array1[] = "Hello";
$array1[] = "Hi";

//hit 2
$size = count($array1);
echo $size."<br/>";


//hit 3
$array2 = array_fill(0, 5, 4);
echo "<pre>";
var_dump($array2);
echo "</pre>";
echo "<br/>";

//hit 4
$array3 = range(4, 10, 2);
echo "<pre>";
var_dump($array3);
echo "</pre>";
echo "<br/>";

//hit 5
$array4 = array_merge($array2, $array3);
echo "<pre>";
var_dump($array4);
echo "</pre>";

//hit 6
$array5 = range(0, 20, 1);
$two_d_array = array_chunk($array5, 4);
echo "<pre>";
var_dump($two_d_array);
echo "</pre>";

//hit 7
$keys = array("Hi", "Hello", "Bye");
$values = array(1, 2, 3);
$array6 = array_combine($keys, $values);
echo "<pre>";
var_dump($array6);
echo "</pre>";

//hit 8
$subarray = array_slice($array5, 0, 5);
echo "<pre>";
var_dump($subarray);
echo "</pre>";


//hit 9
$replace = array(2, 4);
$extracted = array_splice($array5, 0, 1, $replace);
echo "<pre>";
var_dump($array5);
echo "</pre>";


//hit 10

$array7 = array(0, 4, 2, 3,1);
$sorted = asort($array7);
echo "<pre>";
var_dump($array7);
echo "</pre>";


//hit 10

$array7 = array("Hi" => 0, "Hello" => 4, "Bye" => 2, "S" =>3, "A" => 1);
$sorted = ksort($array7);
echo "<pre>";
var_dump($array7);
echo "</pre>";

//hit 11
function odd($var)
{
    // returns whether the input integer is odd
    return($var & 1);
}

echo "<pre>";
var_dump(array_filter($array7, "odd"));
echo "</pre>";


//hit 12
echo array_key_exists("Hi", $array7);

//hit 13
echo "<pre>";
var_dump(array_keys($array7));
echo "</pre>";

//hit 14
echo "<pre>";
var_dump(array_values($array7));
echo "</pre>";

//hit 15
echo "<pre>";
var_dump(array_search(4, $array7));
echo "</pre>";

//hit 16
$array8 = array(0, 1, 2, 1, 3, 0);
echo "<pre>";
var_dump(array_unique($array8));
echo "</pre>";

//hit 17
$array9 = array(0, 1, 2, 10);

echo "<pre>";
var_dump(array_intersect($array8, $array9));
echo "</pre>";


//hit 18
$diff = array_diff($array9, $array8);
echo "<pre>";
var_dump($diff);
echo "</pre>";

//hit 19
$array8 = array(0, 1, 2, 1, 3, 0);
echo "<pre>";
var_dump(array_reverse($array8));
echo "</pre>";

//hit 20
echo "<pre>";
var_dump(array_flip($array7));
echo "</pre>";
