var app = angular.module("myApp", []);
app.controller("loginValidation", function($scope) {
    $scope.password = "";
    $scope.id = "";
    $scope.invalidId = function() {
        var pattern = /^\d{7,}$/;
        return !pattern.test($scope.id);
    }

    $scope.invalidPass = function() {
        return $scope.password.length < 8;
    }
});