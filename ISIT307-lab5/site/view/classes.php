<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> List of classes</h3>
    </div>
    <ul class="pagination pull-right">
        <?php
        if ($active != 0) {
            echo "<li><a href = '?a=class&offset=" . ($active - 1) * $num_items . "'><span class = 'glyphicon glyphicon-chevron-left'></span></a></li>";
        }
        $last_end = $active;
        $print_number = false;
        for ($i = 0; $i < $num_pages; $i++) {
            if ($i == $active) {
                echo "<li class = 'active'><a href = '?a=class&offset=" . $i * $num_items . "'>" . ($i + 1) . "</a></li>";
                continue;
            }
            if ($i < 3 || ($i >= $active - 1 && $i <= $active + 1) || $i > $num_pages - 3) {
                echo "<li><a href = '?a=class&offset=" . $i * $num_items . "'>" . ($i + 1) . "</a></li>";
                $print_number = true;
                continue;
            } else {
                if ($print_number) {
                    echo "<li>...</li>";
                    $print_number = false;
                }
            }
        }
        if ($active != $num_pages - 1) {
            echo "<li><a href = '?a=class&offset=" . ($active + 1) * $num_items . "'><span class = 'glyphicon glyphicon-chevron-right'></span></a></li>";
        }
        ?>
    </ul>
    <div class = "clearfix"></div>
    <div class="panel-group">
        <?php
        foreach ($classes as $class) {
            ?>

            <div class="panel panel-default classes">
                <div class="panel-heading"><h4><?php echo $class['classcode'] . " - " . $class['classname'] ?></h4>
                </div>
                <div class="panel-body">
                    <p>
                        <b>Number of enrolled students:</b>
                        <?php echo $class['num_students'] ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>