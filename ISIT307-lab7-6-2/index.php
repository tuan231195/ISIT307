<?php
function solve_hanoi_towers($from, $to, $middle, $num)
{
    if ($num == 0)
        return;
    solve_hanoi_towers($from, $middle, $to, $num - 1);
    echo "$from -> $to<br/>";
    solve_hanoi_towers($middle, $to, $from, $num - 1);
}

solve_hanoi_towers("first", "second", "third", 12);