<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<?php require_once "public/include/header.php" ?>
<body>
<?php require_once "public/include/navbar.php" ?>
<div class="container">
    <div class="page-header">
        <h3> Add new class</h3>
    </div>
    <div class = "new-class">
        <div class = "col-xs-6 col-sm-5">
            <input type = "text" class = "form-control" name = "new-class" id = "new-class" placeholder="Class code"/>
        </div>

        <button type = "button" id = "add-class" class =  "btn btn-primary">Add</button>
    </div>
    <div class="page-header">
        <h3> List of classes</h3>
    </div>
    <div class = "panel panel-default">
        <table class = "table classes table-bordered table-responsive">
            <tr class = "info">
                <td>Class Code</td>
                <td>Class Name</td>
                <td>Number of enrolled students</td>
                <td>Action</td>
            </tr>
            <?php
            foreach ($classes as $class) {
                ?>
            <tr>
                <td class = "code"><?php echo $class['classcode']?></td>
                <td><?php echo $class['classname']?></td>
                <td><?php echo $class['num_students']?></td>
                <td><button type = "button" class = "btn btn-danger withdraw">Withdraw</button></td>
            </tr>
                <?php
            }
            ?>

        </table>
    </div>
</div>
<script type = "text/javascript">
    $(function(){
        $("#add-class").click(function(){
            var code= $("#new-class").val();
            if (code.length < 3)
            {
                alert("Classcode must have more than 3 characters");
                return;
            }
            $.post("index.php?c=class&a=enrolled", {classcode:code }, function(result){
                result = JSON.parse(result);

                if (result["result"] == 0)
                {code
                    alert("You have successfully enrolled in this class");
                    var newclass = $("<tr/>");
                    var classcode = $("<td/>", {class : code});
                    classcode.text(result["classcode"]);
                    newclass.append(classcode);
                    var classname = $("<td/>");
                    classname.text(result["classname"]);
                    newclass.append(classname);
                    var num_students = $("<td/>");
                    num_students.text(result["num_students"]);
                    newclass.append(num_students);
                    var button = $("<button>", {class: "btn btn-danger withdraw", type: "button"});
                    button.text("Withdraw");
                    newclass.append(button);
                    $(".classes").append(newclass);
                }
                else if (result.result == 1)
                {
                    alert ("You already enrolled in this class");
                }
                else if (result.result == 2)
                {
                    alert("Classcode does not exist");
                }
                else if (result.result == 3)
                {
                    alert("This class is full");
                }

            })
        });

        var deleting = false;
        $(".withdraw").click(function() {
            if (deleting) {
                return;
            }
            var withdraw = confirm("Do you want to withdraw this class?");
            if (withdraw)
            {
                var deletingrow = $(this).parent().parent();
                var code = deletingrow.find(".code").text();
                deleting = true;
                $.post("index.php?c=class&a=cancel", {classcode: code}, function (result) {
                    deleting = false;
                    result = JSON.parse(result);
                    if (result.result == 0) {
                        alert("You have successfully cancelled this class");
                        deletingrow.remove();
                    }
                    else {
                        alert("Fail to cancel the class");
                    }
                });
            }

        });
    });
</script>
</body>
</html>