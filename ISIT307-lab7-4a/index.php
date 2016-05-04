<!doctype>
<html>
<head>
    <title>Task 4A</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
<body>

<?php
if (isset($_GET['state']) && ($_GET['state'] == 'save')) :
// Check if the POST data is blank:
if (count($_POST) == 0) :
    die("ERROR: This page has been improperly accessed.");
else:
    $name = $_POST['shopper-name'];
    $surname = $_POST['shopper-surname'];
    $email = $_POST['shopper-email'];
    $phone = $_POST['shopper-phone'];
    $shop = $_POST['shop'];
    $reason = $_POST['shopp-reason-choose'];
    $items = $_POST['item'];
    $fname = $_FILES['attachment']['name']; //The original name of the file from the user’s machine.
    $type = $_FILES['attachment']['type']; // The mime type of the file
    $size = $_FILES['attachment']['size']; // The size of the file in bytes.
    $tmpname = $_FILES['attachment']['tmp_name']; // the full filename of the uploaded file.
    $ferror = $_FILES['attachment']['error'];
    if (!($_FILES['attachment']['size'])) {
        echo "<p>ERROR: No actual file uploaded</p>\n";
    } else {
        $newname = dirname(__FILE__) . '/images/' . basename($_FILES['attachment']['name']);
        if (!(move_uploaded_file($_FILES['attachment']['tmp_name'], $newname))) {
            //die("ERROR: File didn't upload");
        }
    }
    ?>
    <div class="container-fluid">
        <div class="container">

            <h2>Shopper Receipt Entered Info</h2>
            <div class="container">
                <p><strong>Name: </strong> <?php echo $name; ?></p>
                <p><strong>Surame: </strong> <?php echo $surname; ?></p>
                <p><strong>Email: </strong> <?php echo $email; ?></p>
                <p><strong>Phone: </strong> <?php echo $phone; ?></p>
                <p><strong>Shop: </strong> <?php echo $shop; ?></p>
                <p><strong>Shopping Reason: </strong> <?php echo $reason; ?></p>
            </div>
            <div class="container">
                <p><strong>User Image</strong></p>
                <img src="images/<?php echo $_FILES['attachment']['name']; ?>" />
            </div>
            <div class="container">
                <p><strong>Purchased Items</strong></p>
                <ul>
                    <?php
                    if(!empty($items)):
                        foreach ($items as $num => $val) {
                            echo '<li>' . $val . '</li>';
                        }
                    else:
                        echo "<p>No items</p>";
                    endif;
                    ?>
                </ul>
            </div>

        </div>
    </div>

<?php endif;
else:
$types = array(
    array('id' => 10, 'desc' => 'Leisure'),
    array('id' => 11, 'desc' => 'Groceries'),
    array('id' => 12, 'desc' => 'Work'),
    array('id' => 20, 'desc' => 'Other'),
    array('id' => 33, 'desc' => 'Visitor'),
    array('id' => 34, 'desc' => 'Home Goods'),
    array('id' => 42, 'desc' => 'Technology'),
    array('id' => 44, 'desc' => 'Food'),
    array('id' => 49, 'desc' => 'Exercise'),
);
$options = "<option value=\"\">Reason for shopping</option>\n";
?>
    <div class="container-fluid">
        <div class="container">

            <h2>Shopper Receipt</h2>

            <form action="<?= $_SERVER['PHP_SELF'] ?>?state=save" method="post" id="shopping-list" enctype="multipart/form-data">
                <fieldset class="form-group" id="shopper-info">
                    <label>First Name</label>
                    <input type="text" class="form-control required" name="shopper-name" />

                    <label>Surname</label>
                    <input type="text" class="form-control required" name="shopper-surname" />

                    <label>Email</label>
                    <input type="text" class="form-control required" name="shopper-email" />

                    <label>Phone</label>
                    <input type="text" class="form-control required" name="shopper-phone" />
                </fieldset>

                <fieldset class="form-group" id="shop">
                    <label>Shop</label>
                    <input type="text" class="form-control required" name="shop" />
                </fieldset>

                <fieldset class="form-group" id="user-image">
                    <label>User Image</label>
                    <input type="file" class='form-control required' name="attachment" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
                </fieldset>

                <fieldset class="form-group" id="shopper-reason">
                    <label>Reason for shopping</label>
                    <select name="shopp-reason-choose" class="form-control" id="shopper-reason-select">
                        <?php
                        foreach ($types as $m) {
                            $options .= "<option value=\"{$m['id']}\">{$m['desc']}</option>\n";
                        }
                        echo $options;
                        ?>
                    </select>
                </fieldset>


                <fieldset class="form-group" id="to-do-list">
                    <label>Items to get:</label>
                    <div class="item-wrap"><input type="text" name="item[]" class="required form-control"/></div>

                </fieldset>
                <fieldset class="form-group">
                    <button class="btn btn-primary" id="add-item">Add New Item</button>
                </fieldset>

                <fieldset class="form-group">
                    <input type="submit" class="btn btn primary" id="shopper-submit" value="Submit" />
                </fieldset>

            </form>



        </div>
    </div>

    <script>
        var input = '<div class="item-wrap"><input type="text" name="item[]" class="required form-control"/></div>';
        jQuery(document).ready(function(){
            jQuery('#shopping-list').submit(function(event){
                var error = false;
                jQuery('.required').each(function(){
                    if(jQuery(this).val().length == 0 || jQuery(this).val() == "" || jQuery(this).val() == " " ){
                        jQuery(this).addClass('error-input');
                        error = true;
                    }
                });
                if(jQuery('#shopper-reason-select option:selected').index() == 0){
                    jQuery('#shopper-reason-select').addClass('error-input');
                    error = true;
                }
                if(error){
                    event.preventDefault();
                    return false;
                }
            });
            jQuery('.required').each(function(){
                jQuery(this).focus(function(){
                    if(jQuery(this).hasClass('required')){
                        if(jQuery(this).hasClass('error-input')){
                            jQuery(this).removeClass('error-input');
                        }
                    }
                });
                jQuery('#shopper-reason-select').change(function(){
                    jQuery(this).removeClass('error-input');
                });
            });
            jQuery('#add-item').click(function(event){
                event.preventDefault();
                jQuery('#to-do-list').append(input);
            });
        })
    </script>
<?php endif; ?>
</body>
</html>