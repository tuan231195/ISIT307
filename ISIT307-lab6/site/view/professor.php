<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> List of professors</h3>
    </div>
    <ul class = "pagination pull-right">
        <?php
            if(isset($_GET['keyword']))
            {
                $href="?keyword=".$_GET['keyword'];
            }
             else{
                $href="?";
            }

            if ($active != 0)
            {
                echo "<li><a href = '$href&a=professor&offset=". ($active - 1) * $num_items ."'><span class = 'glyphicon glyphicon-chevron-left'></span></a></li>";
            }
            $last_end = $active;
            $print_number = false;
            for ($i = 0; $i < $num_pages; $i++)
            {
                if ($i == $active)
                {
                    echo "<li class = 'active'><a href = '$href&a=professor&offset=". $i * $num_items ."'>".($i + 1) ."</a></li>";
                    continue;
                }
                if ($i < 3 || ($i >= $active - 1 && $i <= $active+1) || $i > $num_pages - 3)
                {
                    echo "<li><a href = '$href&a=professor&offset=". $i * $num_items ."'>".($i + 1) ."</a></li>";
                    $print_number = true;
                    continue;
                }
                else
                {
                    if ($print_number)
                    {
                        echo "<li>...</li>";
                        $print_number = false;
                    }
                }
            }
            if ($num_pages != 0 && $active != $num_pages - 1)
            {
                echo "<li><a href = '$href&a=professor&offset=". ($active + 1) * $num_items ."'><span class = 'glyphicon glyphicon-chevron-right'></span></a></li>";
            }
        ?>
    </ul>
    <div class = "clearfix"></div>
    <div class="panel-group">
        <?php
        foreach ($professors as $professor) {
            ?>
            <div class="panel panel-default professor">
                <div class="panel-heading"><a href = "index.php?a=professor&professorId=<?php echo $professor['professorid']?>"><h4><?php echo $professor['fname']. " " . $professor['sname'] ?></h4></a></div>
                <div class = "panel-body">
                    <?php echo $professor['schoolname'] ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>