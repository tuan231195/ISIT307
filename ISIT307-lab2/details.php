<html>
<?php
require_once("include/header.php");
?>
<body>
<?php
require_once("include/navbar.php");
?>
<div class="container car">
    <div class="ajax-body">
    </div>
</div>

<script type = "text/javascript" src = "js/util.js"></script>
<script>
    function displayXML(xml) {
        var cars = $(xml).find("car");
        console.log(cars);
        if (cars.length == 0) {

            $(".ajax-body").html("Sorry, this car does not exist.");
        }
        else {
            $(".ajax-body").html("");

            cars.each(function (car) {
                var sellers = "";
                var count = 0;
                $(this).find("names").find("name").each(function(){
                    if (count != 0)
                    {
                        sellers += ", ";
                    }
                    sellers += $(this).text();
                    count ++;
                });
                var price = $(this).find("price").text();

                var email = $(this).find("email").text();
                var plateNumber = $(this).find("plate_number").text();
                var phone = $(this).find("phone").text();
                var model = $(this).find("model").text();
                var image = $(this).find("image").text();
                var manu = $(this).find("manu").text();
                var header = $("<div/>", {class: "page-header"});
                header.html("<h2>Car details</h2>");

                var imageDiv = $("<img/>", {src: image, class: 'thumbnail'});
                var plateDiv = $("<h4/>", {class:"form-group"});
                var form = $("<form/>", {method : "post", action : "buyer.php"});
                plateDiv.text("Plate number: #" + plateNumber);
                var priceDiv = $("<h5/>", {class:"form-group"});
                priceDiv.text("Price: $" + price);
                var sellerDiv = $("<div/>", {class:"form-group"});
                sellerDiv.text("Sellers: " + sellers);
                var phoneDiv = $("<div/>", {class:"form-group"});
                phoneDiv.text("Phone: " + phone);
                var emailDiv = $("<div/>", {class:"form-group"});
                emailDiv.text("Email: " + email);
                var modelDiv = $("<div/>", {class:"form-group"});
                modelDiv.text("Model: " + model);
                var manuDiv = $("<div/>", {class:"form-group"});
                manuDiv.text("Manufacturer: " + manu);
                var hiddenInput = $("<input/>", {type :"hidden", name : "plate-number", value : plateNumber})
                var button = $("<button>", {type: "submit", class : "btn btn-primary"});
                button.text("Buy it");
                form.append(imageDiv, plateDiv, manuDiv, modelDiv, priceDiv, sellerDiv, phoneDiv, emailDiv, hiddenInput, button);
                $(".ajax-body").append(header, form);
            });
        }
    }

    $(document).ready(function () {
        $.ajax({
            url: "allcars.php?exact_match&&plate_number=" + encodeURI(getParameterByName('plate_number')),
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