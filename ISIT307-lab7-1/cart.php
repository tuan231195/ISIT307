<html>
<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 3/05/2016
 * Time: 8:58 PM
 */

$title = "Cart";
$page = "cart";
require_once('include/header.php');
require_once('include/navbar.php');
require_once('classes/LineItem.php');
require_once('classes/StockedItem.php');
session_start();
// If the validsubmit session variable doesn't exist, create it to be true:
if (!isset($_SESSION['validsubmit']))
{
    $_SESSION['validsubmit'] = true;
}
?>

<body>
<div class="container">
    <div class="page-header">
        <h3>Your cart</h3>
    </div>

    <?php
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0)
    {
    ?>
    <table class="table table-bordered table-responsive">
        <tr>
            <td style = "width:20%;">Image</td>
            <td style = "width:50%;">Item name</td>
            <td style = "width:10%;">Quantity</td>
            <td style = "width:10%;">Price</td>
            <td style = "width:10%;">Action</td>
        </tr>
        <?php
        foreach ($_SESSION['cart'] as $item) {
            ?>
            <tr>
                <td><img class="thumbnail table-image"
                         src="images/<?php echo $item->getStockedItem()->getImage() ?>">
                </td>
                <td><?php echo $item->getStockedItem()->getTitle() ?></td>
                <td><input class="quantity" type='text' size="4"
                           data-price="<?php echo $item->getStockedItem()->getPrice() ?>"
                           value='<?php echo $item->getQuantity() ?>'/></td>
                <td class="total">$<?php echo $item->getStockedItem()->getPrice() * $item->getQuantity() ?></td>
                <td>
                    <button type="button" class="btn btn-danger remove"
                            data-item="<?php echo $item->getStockedItem()->getItemNumber() ?>">Remove
                    </button>
                </td>
            </tr>
            <?php
        }
        }
        else {
            echo "No item in your cart";
        }
        ?>

    </table>
    <button type="button" class="btn btn-primary pull-right" id="checkout-btn">Proceed to checkout</button>
    <div class="clearfix"></div>
    <div class="margin-wrapper detail">

        <fieldset>
            <legend>Payment details</legend>
            <form action="process.php" method="POST">
                <div class="form-group">
                    <label for="type">Select type:</label>
                    <select class="form-control" name = "type" id = "type">
                        <option value = "m">
                            Master card
                        </option>
                        <option value = "v">
                            Visa
                        </option><option value = "d">
                            Discover
                        </option>
                        <option value = "a">
                            American Express
                        </option>
                    </select>


                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="card_number" placeholder="Enter your card number:"/>
                </div>


                <button type="submit" class="btn btn-primary">Pay</button>
            </form>
        </fieldset>
    </div>

</body>
<script type="text/javascript">
    $('.detail').hide();
    $('.quantity').on('keyup', function () {
        var value = $(this).val();
        if (value.trim().length == 0)
            return;
        if ($.isNumeric($(this).val())) {
            $(this).parent().next().text("$" + $(this).data("price") * $(this).val());
        }
        else {
            $('.quantity').val(1);
            $(this).parent().next().text("$" + $(this).data("price") * $(this).val());
        }
    });

    $(".remove").on('click', function () {
        var row = $(this).parent().parent();
        $.post("background/cart-delete.php", {'item_number': $(this).data('item')}, function (result) {
            result = JSON.parse(result);
            if (result.code == 1) {
                row.remove();
            }
            else {
                alert("Failed to remove item");
            }
        });
    });
    $("#checkout-btn").click(function () {
        $('.detail').show();
    });
</script>
</html>

