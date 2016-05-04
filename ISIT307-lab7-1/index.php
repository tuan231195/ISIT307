<html>
<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 8:05 PM
 */
require_once('util/Db_Handler.php');
$dbHandler = new DbHandler();
$title = "Home";
$page = "index";
require_once('include/header.php');
require_once('include/navbar.php');
require_once('classes/Category.php');
require_once('classes/LineItem.php');
require_once('classes/StockedItem.php');


$categoryArr = $dbHandler->executeQuery("Select * from category");
$categories = array();
foreach ($categoryArr as $categoryRow) {
    $category = new Category();
    $category->init($categoryRow);
    $categories[] = $category;
}
?>
<body ng-app="myApp">

<div class="container">
    <div class="page-header">
        <h3>Featured items</h3>
    </div>

    <div class="form-group">
        <label for="category">Select category:</label>
        <select class="form-control" id="category">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->getCategoryNumber() ?>">
                    <?php echo $category->getTitle(); ?>
                </option>
            <?php endforeach; ?>
        </select>


    </div>
    <div class="items" ng-controller="myController">
        <div class="wrapper col-sm-6 col-lg-4" ng-repeat="item in items">
            <div class="item panel panel-default">
                <div class="col-xs-5">
                    <img class="thumbnail display-image" src="images/{{item.img}}"/>
                </div>
                <div class='col-xs-7'>
                    <h5 class="pull-left">
                        {{item.title}}
                    </h5>
                    <h6 class="text-danger pull-right">
                        {{item.price}}$
                    </h6>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <button type="button" class="btn btn-primary add-to-cart-btn" ng-click="addToCart(item.item_number)"
                        ng-disabled="isInCart(item.item_number)">
                    Add to cart
                </button>


            </div>
        </div>


    </div>

</div>


</body>

<script type="text/javascript">

    <?php
    session_start();
    $item_lists = array();
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $item_lists[] = $item->getStockedItem()->getItemNumber();
        }
    }

    ?>
    var app = angular.module("myApp", []);
    app.controller("myController", function ($scope, $http) {

        var items = "<?php echo implode(",", $item_lists);?>";
        $scope.itemList = items.split(",");
        console.log($scope.itemList);
        $scope.addToCart = function (item_number) {
            var data = $.param({
                "item_number": item_number
            });

            var config = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }
            $http.post('background/cart.php', data, config)
                .success(function (data, status, headers, config) {
                    var result = angular.fromJson(data);
                    if (result.code == 1) {
                        alert("Item added");
                    }
                    else {
                        alert("Item is already in your cart")
                    }
                    $scope.itemList.push(item_number + "");

                });

        };

        $scope.isInCart = function (item_number) {
            return ($scope.itemList.indexOf(item_number + "") !== -1);
        }
        getItems();
        $("#category").on("change", function () {
            getItems();
        });

        function getItems() {
            $http.get("background/items.php?category_number=" + $("#category").val()).success(function (result) {
                    $scope.items = result;
                }
            );
        }
    });

</script>
</html>