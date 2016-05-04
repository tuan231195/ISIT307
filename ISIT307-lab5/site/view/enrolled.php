<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> List of classes</h3>
    </div>
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