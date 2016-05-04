<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> Searches</h3>
    </div>
    <form action = "?c=search&a=search" method = "POST">
        <div class = "form-group">
            <label for "">Keywords</label>
            <input type = "text" class = "form-control" name = "keyword"/>

        </div>
        <div class="form-group">
            <label for="sel1">Select criteria</label>
            <select name  = "criteria" class="form-control" id="sel1">
                <option value = "school">School</option>
                <option value = "course">Course</option>
                <option value = "professor">Professor</option>
            </select>
        </div>
        <button type = "submit" class = "btn btn-primary" >Submit</button>
    </form>

</div>
</body>
</html>