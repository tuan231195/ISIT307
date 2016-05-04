<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> List of departments</h3>
    </div>
    <div class="panel-group">
        <?php
        foreach ($departments as $department) {
            ?>

            <div class="panel panel-default department">
                <div class="panel-heading"><a href = "?a=course&department=<?php echo $department['departmentname']?>"><h4><?php echo $department['departmentname'] ?></h4></a></div>
                <div class="panel-body"><?php echo $department['schoolname'] ?></div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>