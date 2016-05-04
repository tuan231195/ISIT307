<!DOCTYPE html>
<html>

<?php
$page = "sell";
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

$num_fields = 1;
$form_ok = 1;

if (isset($_POST['submit'])) {
    if (isset($_POST['name'])) {
        $num_fields = count($_POST['name']);
        for ($i = 0; $i < $num_fields; $i++) {
            if (strlen(trim($_POST['name'][$i])) >= 3) {
                if (preg_match("/^[a-zA-Z ]*$/", $_POST['name'][$i]))
                    $name[$i] = trim($_POST['name'][$i]);
                else
                {
                    $form_ok = 0;
                    $error_name[$i] = "Only letters and white space allowed";
                }

            } else
            {
                $error_name[$i] = "The name must have more than 3 characters";
                $form_ok = 0;
            }

        }
    }
    if (isset($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        } else
        {
            $error_email = "You must enter a valid email";
            $form_ok = 0;
        }
    }
    if (isset($_POST['telephone'])) {
        if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST['telephone'])) {
            $phone = $_POST['telephone'];
        } else
        {
            $error_phone = "You must enter a valid phone";
            $form_ok = 0;
        }

    }
    if (isset($_POST['plate-number'])) {
        if (is_numeric($_POST['plate-number'])) {
            $plate_number = $_POST['plate-number'];
        } else
        {
            $error_plate = "You must enter a valid plate number";
            $form_ok = 0;
        }

    }

    if (isset($_POST['price'])) {
        if (is_numeric($_POST['price'])) {
            $price = $_POST['price'];
        } else
        {
            $error_price = "You must enter a valid price";
            $form_ok = 0;
        }

    }

    if (isset($_POST['manufacturer'])) {
        if (!empty(trim($_POST['manufacturer']))) {
            $manu = $_POST['manufacturer'];
        } else
        {
            $error_manu= "You must enter a manufacturer";
            $form_ok = 0;
        }

    }

    if (isset($_POST['model'])) {
        if (!empty(trim($_POST['model']))) {
            $model = $_POST['model'];
        } else
        {
            $error_model = "You must enter a model";
            $form_ok = 0;
        }

    }

    $uploadOk = 1;
    if (empty($_FILES['image']['name'])) {
        $uploadOk = 0;
        $error_image = "Sorry, you must select an image.";
    } else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error_image = "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if ($uploadOk && file_exists($target_file)) {
            $error_image = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($uploadOk && $_FILES["image"]["size"] > 500000) {
            $error_image = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($uploadOk && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error_image = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk && $form_ok) {
            $saved_file = $target_dir . uniqid(). ".". $imageFileType;
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $saved_file)) {
                $error_image = "Sorry, there was an error uploading your file.";
            }
        }

    }


    if (isset($phone) && isset($email) && isset($name) && (count($name) == $num_fields) && isset($plate_number) &&
        isset($price) && $uploadOk && isset($manu) && isset($model)
    ) {
        $filename = 'directory.txt';
        $handle = fopen($filename, 'a+');
        $array = array();
        $array['plate_number'] = $plate_number;
        $array['price'] = $price;
        $array['email'] = $email;
        $array['phone'] = $phone;
        $array['name'] = $name;
        $array['manu'] = $manu;
        $array['model'] = $model;
        $array['plate_number'] = $plate_number;
        $array['image'] = $saved_file;
        fprintf($handle, "\n%s", json_encode($array));
        fclose($handle);
        header("Location: index.php");
    }
}
?>
<div class="container">
    <div class="page-header">
        <h2>Selling a car</h2>
    </div>
    <form name="myForm"  action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Sellers information</legend>
            <div class="seller-names">
                <?php
                for ($i = 0; $i < $num_fields; $i++) {
                    ?>
                    <div class='seller'>
                        <div class="form-group">
                            <label>Seller name </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name[]"
                                       value="<?php echo ifsetor($_POST['name'][$i]) ?>"
                                       required/>
                                <span class="input-group-btn">
                                    <button onclick='removeSeller(this)' class="btn btn-default" type="button">
                                        &times;
                                    </button>
                                </span>
                            </div>

                            <div class="error">
                                <?php echo ifsetor($error_name[$i]); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-number" onclick="addSeller()">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>

            <div class="form-group">
                <label>Email contact</label>
                <input type="text" class="form-control" name="email" value="<?php echo ifsetor($_POST['email']) ?>"
                       required>
                <div class="error">
                    <?php echo ifsetor($error_email); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Phone contact</label>
                <input type="text" class="form-control" name="telephone"
                       value="<?php echo ifsetor($_POST['telephone']) ?>"
                       required>
                <div class="error">
                    <?php echo ifsetor($error_phone); ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Car information</legend>

            <div class="form-group">
                <label>Plate number</label>
                <input type="text" class="form-control" name="plate-number"
                       value="<?php echo ifsetor($_POST['plate-number']) ?>" required>
                <div class="error">
                    <?php echo ifsetor($error_plate); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Manufacturer</label>
                <input type="text" class="form-control" name="manufacturer"
                       value="<?php echo ifsetor($_POST['manufacturer']) ?>" required>
                <div class="error">
                    <?php echo ifsetor($error_manu); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Model</label>
                <input type="text" class="form-control" name="model"
                       value="<?php echo ifsetor($_POST['model']) ?>" required>
                <div class="error">
                    <?php echo ifsetor($error_model); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control" name="price" value="<?php echo ifsetor($_POST['price']) ?>"
                       required>
                <div class="error">
                    <?php echo ifsetor($error_price); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Select File</label>
                <input id="images" name="image" type="file" accept="image/*" class="file-loading">
                <div class="error">
                    <?php echo ifsetor($error_image); ?>
                </div>
            </div>

        </fieldset>
        <div class="form-group">
            <input name="submit" type="submit" class="btn btn-primary"/>
        </div>

    </form>
</div>
</div>
<script>
    function removeSeller(caller) {
        var pos = $(".seller").index($(caller).closest(".seller"));
        if (pos == 0)
            return;
        $(caller).closest(".seller").remove();
    }

    $(document).ready(function () {
        $("#images").fileinput({
            showUpload: false,
            layoutTemplates: {
                main1: "{preview}\n" +
                "<div class=\'input-group {class}\'>\n" +
                "   <div class=\'input-group-btn\'>\n" +
                "       {browse}\n" +
                "       {upload}\n" +
                "       {remove}\n" +
                "   </div>\n" +
                "   {caption}\n" +
                "</div>"
            }
        });
    });

    function addSeller() {
        var newSeller = $(".seller").first().clone(true);
        newSeller.find("input").val("");
        newSeller.find(".error").html("")
        newSeller.appendTo($(".seller-names"));
    }

    $("input[name='name[]']").on('keyup blur', function () {
        var name = $(this).val();
        if (name.length < 3) {
            $(this).parent().next().text("The name must have more than 3 characters");
        }
        else {
            var pattern = /^[a-zA-Z ]*$/;
            if (!pattern.test(name)) {
                $(this).parent().next().text("Only character and space are allowed");
            }
            else {
                $(this).parent().next().text("");
            }
        }


    });

    $("input[name='telephone']").on('keyup blur', function () {
        var telephone = $(this).val();
        var pattern = /^[0-9]{3}-[0-9]{4}-[0-9]{4}$/;
        if (!pattern.test(telephone)) {
            $(this).next().text("Invalid phone");
        }
        else {
            $(this).next().text("");
        }

    });

    $("input[name='email']").on('keyup blur', function () {
        var email = $(this).val();
        var pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
        if (!pattern.test(email)) {
            $(this).next().text("Invalid email");
        }
        else {
            $(this).next().text("");
        }
    });

    $("input[name='plate-number']").on('keyup blur', function () {
        var plateNumber = $(this).val();
        if (!$.isNumeric(plateNumber)) {
            $(this).next().text("Invalid plate number");
        }
        else {
            $(this).next().text("");
        }
    });

    $("input[name='price']").on('keyup blur', function () {
        var price = $(this).val();
        if (!$.isNumeric(price)) {
            $(this).next().text("Invalid price");
        }
        else {
            $(this).next().text("");
        }
    });

    $("input[name='model']").on('keyup blur', function () {
        var model = $(this).val();
        if (model.length == 0) {
            $(this).next().text("Model is required");
        }
        else {
            $(this).next().text("");
        }
    });

    $("input[name='manufacturer']").on('keyup blur', function () {
        var manu = $(this).val();
        if (manu.length == 0) {
            $(this).next().text("Manufacturer is required");
        }
        else {
            $(this).next().text("");
        }
    });
</script>
</body>

</html>