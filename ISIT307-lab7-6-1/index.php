<?php
function find_smallests($arr, &$smallest)
{
    if (is_array($arr))
    {
        foreach ($arr as $key => $value)
        {
            if(is_array($value))
            {
                find_smallests($value, $smallest);
            }
            else if (is_numeric($value))
            {
                if ($smallest > $value)
                {
                    $smallest = $value;
                }
            }
        }
    }
}


$arr1 = array(0, array(1,2,3), array(-9, 3));
$smallest = PHP_INT_MAX;
echo "<pre>";
print_r($arr1);
echo "</pre>";
find_smallests($arr1, $smallest);
echo $smallest;