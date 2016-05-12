<!doctype>
<html>
<head>
    <?php session_start();
    require_once('scripts/Db_Handler.php');
    $dbHandler = new DBHandler();
    ?>

    <?php if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }

    ?>

    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script
        src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
</head>

<header>
    <?php
    $page = "exam";
    include('inc/nav.php');
    require_once('scripts/db.php');
    ?>
</header>
<body ng-app="myApp">
<div class="container-fluid">
    <div class="col-xs-10 col-xs-offset-1">
        <h2>Hello <?php echo  $_SESSION['username']?></h2>
        <br/>
        <br/>
        <br/>
        <?php
        $result = $dbHandler->prepareQuery("SELECT * FROM attempts WHERE studentid = ?", "s", array($_SESSION['studentid']));
        if (count($result) > 0 && $result[0]['status'] != 'U'):
            if ($result[0]['status']== 'P'):
                echo "You have passed the exam";
            else:
                echo "You have failed the exam";
            endif;
        else:
        ?>
        <div class="questions" ng-controller="myController">
            <fieldset>
                <legend>
                    Exam
                </legend>
                <table class="table">
                    <tr>
                        <td style="width: 5%">
                            <button class="btn btn-default pull-left" ng-click="prev()"><span
                                    class='glyphicon glyphicon-chevron-left'></span>
                            </button>
                        </td>
                        <td>
                            <select class="form-control" ng-model="currentIndex">
                                <option ng-repeat="i in range" value={{i}}>{{i + 1}}/{{range.length}}</option>
                            </select>
                        </td>
                        <td style="width: 5%">
                            <button class="btn btn-default pull-right" ng-click="next()"><span
                                    class='glyphicon glyphicon-chevron-right'></span></button>
                        </td>
                    </tr>
                </table>
                <div class="question">
                    <div class="question-title"><h6>{{questions[currentIndex]["question"]}}</h6></div>
                    <div class="list-group">
                        <div class="list-group-item">{{questions[currentIndex]["choices"]["A"]}}</div>
                        <div class="list-group-item">{{questions[currentIndex]["choices"]["B"]}}</div>
                        <div class="list-group-item">{{questions[currentIndex]["choices"]["C"]}}</div>
                        <div class="list-group-item">{{questions[currentIndex]["choices"]["D"]}}</div>
                    </div>
                </div>
                <br/>
                <br/>
                <br/>
                <legend>Your answer</legend>
                <p>Please upload your answer sheet</p>
                <form action="scripts/exam-file.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="user-file" class="form-control"/>
                    <input type="hidden" name="sequence" value="{{sequence}}"/>
                    <input type="submit" style='margin-top:2%;' name="user-exam-file" value="Submit"
                           class="btn btn-primary"/>
                </form>
            </fieldset>
        </div>
    </div>
    <script type="text/javascript">
        function shuffle(a) {
            var j, x, i;
            for (i = a.length; i; i -= 1) {
                j = Math.floor(Math.random() * i);
                x = a[i - 1];
                a[i - 1] = a[j];
                a[j] = x;
            }
        }
        var app = angular.module("myApp", []);
        app.controller("myController", function ($scope, $http) {
            $http.get("exam-generator.php").success(function (result) {
                $scope.questions = result;
                $scope.size = $scope.questions.length;
                $scope.prev = function () {
                    if ($scope.currentIndex > 0)
                        $scope.currentIndex--;
                }

                $scope.next = function () {
                    if ($scope.currentIndex < $scope.size - 1)
                        $scope.currentIndex++
                }

                for (var i = 0; i < $scope.size; i++) {
                    console.log(i);
                    $scope.questions[i]["choices"] = JSON.parse($scope.questions[i]["choices"]);
                }

                shuffle($scope.questions);
                $scope.sequence = "";
                for (var i = 0; i < $scope.size; i++) {
                    if (i > 0)
                        $scope.sequence += ",";
                    $scope.sequence += $scope.questions[i]["questionID"];
                }
                $scope.range = new Array();
                $scope.currentIndex = 0;
                for (var i = 0; i < $scope.size; i++) {
                    $scope.range.push(i);
                }

            });
        });
    </script>
    <?php
    endif;
    ?>
</div>
</body>
</html>