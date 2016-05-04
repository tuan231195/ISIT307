<!DOCTYPE html>
<html>

<?php
require_once("include/header.php");
?>
<body>
<?php
require_once("include/navbar.php");
?>


<?php
function ifsetor(&$variable, $default = null)
{
    if (isset($variable)) {
        $tmp = $variable;
    } else {
        $tmp = $default;
    }
    return $tmp;
}

if (!isset($_POST['plate-number']))
{
    header("Location:index.php");
}
if (isset($_POST['submit'])) {
    if (isset($_POST['name'])) {
        if (strlen(trim($_POST['name'])) >= 3) {
            if (preg_match("/^[a-zA-Z ]*$/", $_POST['name']))
                $name = $_POST['name'];
            else
                $error_name = "Only letters and white space allowed";
        } else
            $error_name = "The name must have more than 3 characters";
    }

    if (isset($_POST['telephone'])) {
        if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST['telephone'])) {
            $phone = $_POST['telephone'];
        } else
            $error_phone = "You must enter a valid phone";
    }

    if (isset($_POST['price'])) {
        if (is_numeric($_POST['price'])) {
            $price = $_POST['price'];
        } else
            $error_price = "You must enter a valid price";
    }


    if (isset($phone) && isset($name) && isset($price)) {
        $filename = 'buyer.txt';
        $handle = fopen($filename, 'a+');
        fprintf($handle, "\n%s:%s:%s:%s", $_POST['plate-number'], $price, $name, $phone);
        fclose($handle);
        header("Location: index.php");
    }
}
?>
<div class="container">
    <div class="page-header">
        <h2>Wanna buy a car</h2>
    </div>
    <form name="myForm" action="" method="post">
        <div class="form-group">
            <label>Your name </label>
            <input type="text" class="form-control" name="name" value="<?php echo ifsetor($_POST['name']) ?>" required>
            <div class="error">
                <?php echo ifsetor($error_name); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Your telephone</label>
            <input type="text" class="form-control" name="telephone" value="<?php echo ifsetor($_POST['telephone']) ?>"
                   required>
            <div class="error">
                <?php echo ifsetor($error_phone); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Proposed Price</label>
            <input type="text" class="form-control" name="price" value="<?php echo ifsetor($_POST['price']) ?>"
                   required>
            <div class="error">
                <?php echo ifsetor($error_price); ?>
            </div>
        </div>
        <input type="hidden" name="plate-number" value="<?php echo ifsetor($_POST['plate-number']) ?>">
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-primary"/>
        </div>
    </form>
</div>
</div>
<script>
    $("input[name='name']").keyup(function () {
        var name = $(this).val();
        if (name.length < 3) {
            $(this).next().text("The name must have more than 3 characters");
        }
        else {
            var pattern = /^[a-zA-Z ]*$/;
            if (!pattern.test(name)) {
                $(this).next().text("Only character and space are allowed");
            }
            else {
                $(this).next().text("");
            }
        }


    });

    $("input[name='telephone']").keyup(function () {
        var telephone = $(this).val();
        var pattern = /^[0-9]{3}-[0-9]{4}-[0-9]{4}$/;
        if (!pattern.test(telephone)) {
            $(this).next().text("Invalid phone");
        }
        else {
            $(this).next().text("");
        }

    });


    $("input[name='price']").keyup(function () {
        var price = $(this).val();
        if (!$.isNumeric(price)) {
            $(this).next().text("Invalid price");
        }
        else {
            $(this).next().text("");
        }
    });
</script>
</body>

</html>