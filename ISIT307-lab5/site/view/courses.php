<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> List of courses</h3>
    </div>
    <div class="panel-group">
        <?php
        foreach ($courses as $course) {
            ?>

            <div class="panel panel-default course">
                <div class="panel-heading"><a href = "?a=class&coursename=<?php echo $course['coursename']?>"><h4><?php echo $course['coursename'] ?></h4></a></div>

                <div class="panel-body">
                    <p>
                        <b>Number of classes: </b>
                        <?php echo $course['num_classes']?>
                    </p>
                    <p>
                        <b>Number of students:</b>
                        <?php echo $course['num_students']?>
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