<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> List of schools</h3>
    </div>
    <div class="panel-group">
        <?php
        foreach ($schools as $school) {
            ?>

            <div class="panel panel-default school">
                <div class="panel-heading"><a href = "index.php?a=department&school=<?php echo $school['schoolname']?>"><h4><?php echo $school['schoolname'] ?></h4></a></div>
                <div class = "panel-body">
                    Professors: (<?php echo count($school['professors'])?> professors)
                    <ul class = "professors-list">
                        <?php
                            foreach($school['professors'] as $professor)
                            {
                                echo "<li>${professor['fname']} ${professor['sname']}</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>