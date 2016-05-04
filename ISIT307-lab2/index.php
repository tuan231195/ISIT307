<!DOCTYPE html>
<html>
<?php
$page = "home";
require_once("include/header.php");
?>
<body>
<?php
require_once("include/navbar.php");
?>

<div class="jumbotron">

</div>
<div class="container">
    <div class="page-header">
        <h3>Looking for a car?</h3>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Enter the plate number"/>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="container cars">
        <div class="panel-group ajax-body">

        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="js/util.js"></script>
<script>
    function displayXML(xml) {
        var cars = $(xml).find("car");
        var numMatched = parseInt($(xml).find("total").text());
        var curPage = parseInt($(xml).find("cur").text());
        var plate = parseInt($(xml).find("query").text());
        console.log(plate);
        if (cars.length == 0) {

            $(".ajax-body").html("No cars available");
        }
        else {
            $(".ajax-body").html("");

            var pages = $("<ul>", {class: "pagination pull-right"});
            $(".ajax-body").append(pages);
            for (var i = 0; i < numMatched; i++) {
                var li;
                if (i == curPage) {
                    li = $("<li/>", {class: "active"});
                }
                else {
                    li = $("<li/>");
                }
                var query = "index.php?first=" + i;
                if ($.isNumeric(plate)) {
                    query += "&plate_number=" + plate;
                }
                var a = $("<a/>", {href: query});
                a.text(i + 1);
                li.append(a);
                pages.append(li);
            }
            $(".ajax-body").append(pages);
            $(".ajax-body").append("<div class = 'clearfix'></div>");
            cars.each(function () {
                var sellers = "";
                var count = 0;
                $(this).find("names").find("name").each(function () {
                    if (count != 0) {
                        sellers += ", ";
                    }
                    sellers += $(this).text();
                    count++;
                });

                var image = $(this).find("image").text();
                var price = $(this).find("price").text();
                var plateNumber = $(this).find("plate_number").text();
                var phone = $(this).find("phone").text();
                var model = $(this).find("model").text();
                var manu = $(this).find("manu").text();
                var panel = $("<div/>", {class: "panel panel-default"});
                var panel_heading = $("<div/>", {class: "panel-heading"});
                var plateDiv = $("<h4/>", {class: "pull-left"});
                var link = $("<a/>", {class: "plate-link", href: "details?plate_number=" + plateNumber});
                link.text("Plate number: #" + plateNumber);
                plateDiv.append(link);
                var priceDiv = $("<h5/>", {class: "pull-right"});
                priceDiv.text("$" + price);
                var clearfix = $("<div/>", {class: "clearfix"});
                panel_heading.append(plateDiv, priceDiv, clearfix);
                var panel_body = $("<div/>", {class: "panel-body"});
                var sellerDiv = $("<div/>", {class: "md"});


                sellerDiv.text("Sellers: " + sellers);
                var phoneDiv = $("<div/>");
                phoneDiv.text("Phone: " + phone);

                var modelDiv = $("<div/>");
                modelDiv.text("Model: " + model);

                var manuDiv = $("<div/>");
                manuDiv.text("Manufacturer: " + manu);

                var imageDiv = $("<div/>", {class: "col-sm-4"});

                var img = $("<img/>", {src: image, class: "thumbnail car-image"});
                imageDiv.append(img);
                var infoDiv = $("<div/>", {class: "col-sm-7 col-sm-offset-1 infoDiv"});
                infoDiv.append(sellerDiv, phoneDiv, manuDiv, modelDiv);

                panel_body.append(imageDiv, infoDiv);

                panel.append(panel_heading, panel_body);
                $(".ajax-body").append(panel);
            });
        }
    }

    $(document).ready(function () {
        var first = getParameterByName('first');
        var plate = getParameterByName('plate_number');
        var query = "";
        if ($.isNumeric(first)) {
            query = "?first=" + first;
        }
        if ($.isNumeric(plate)) {
            query += "&plate_number=" + plate;
            $("#search").val(plate);
        }
        $.ajax({
            url: "allcars.php" + query,
            type: "GET",
            dataType: "xml",
            success: function (xml) {
                displayXML(xml);
            }
        });
    });

    $("#search").keyup(function () {
        var val = $("#search").val();
        var query = "";
        if ($.isNumeric(val)) {
            query = "?plate_number=" + encodeURI(val);
        }
        $.ajax({
            url: "allcars.php" + query,
            type: "GET",
            dataType: "xml",
            success: function (xml) {
                displayXML(xml);
            }
        });
    });
</script>
</body>
</html>