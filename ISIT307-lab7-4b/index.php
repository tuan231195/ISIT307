<?php

$function_arrays = array(
    1 => create_function('$n', 'if ($n > 1){echo "<p>$n is greater than 1</p>";}'),
    2 => create_function('$n', 'if ($n > 2){echo "<p>$n is greater than 2</p>";}'),
    3 => create_function('$n', 'if ($n > 3){echo "<p>$n is greater than 3</p>";}'),
    4 => create_function('$n', 'if ($n > 4){echo "<p>$n is greater than 4</p>";}'),
    5 => create_function('$n', 'if ($n > 5){echo "<p>$n is greater than 5</p>";}'));
foreach ($function_arrays as $function)
{
    $function(4);
    $function(6);
}
