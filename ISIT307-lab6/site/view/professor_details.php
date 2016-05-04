<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> Professor Details</h3>
    </div>
    <div>
        <p><b>Professor id:</b> <?php echo $professor['professorid'] ?></p>
        <p><b>Professor name:</b> <?php echo "{$professor['fname']} {$professor['sname']}" ?></b></p>
        <p><b>School name:</b> <?php echo $professor['schoolname'] ?></p>
        <p><b>Classes: </b></p>
        <ul class = "classes-list">
            <?php
                foreach($professor['classes'] as $class) {
                    ?>
                    <li>
                        <?php echo strtoupper($class['classcode']) . " - " . $class['classname']?>
                    </li>
                    <?php
                }
            ?>
        </ul>
        <p> <b> Teaching: </b></p>
        <ul class = "students-list">
            <?php
            foreach($professor['students'] as $student) {
                ?>
                <li>
                    <?php echo ($student['fname']) . " ". $student['sname'] . " ( " . $student['studentid']. " ) "?>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
</body>
</html>