<!doctype>
<html>
<head>
    <?php session_start(); ?>

    <?php if(isset($_SESSION['username'])){ header("Location: http://isit.local/ass7/task2/profile.php"); } ?>
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

<div class="container-fluid">
    <div class="container">
        <div class="col-sm-6" id="login-square">
            <h1>Log in to your account</h1>
            <?php if(isset($_GET['logout'])):
                session_destroy();  ?>
                <h4 id="log-note">You have been logged out</h4>
            <?php endif; ?>
            <h4 id="error-login" style="display: none;">Login Failed. Please ensure you enter the correct login</h4>
            <form method="POST" action="scripts/user.php" id="login-form" onsubmit="return validate()">
                <div class="container-fluid">
                    <label>Username</label>
                    <input class="form-control" name="username" type="text" />
                </div>

                <div class="container-fluid">
                    <label>Password</label>
                    <input class="form-control" name="password" type="password" />
                </div>
                <div class="container-fluid">
                    <input class="btn btn-primary" name="login-button" type="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#log-note').delay(2000).fadeOut('fast');
    });
    function validate() {

        var exp = new RegExp(/[^a-zA-Z0-9]+$/);
        var username = jQuery('input[name="username"]').val()
        var password = jQuery('input[name="password"]').val()
        if(username.match(exp) || password.match(exp) || username.length == 0 || password.length == 0){
            jQuery('#error-login').fadeIn('fast');
            jQuery('#error-login').delay(2000).fadeOut('fast');
            return false
        }else {
            return true;

        }
    }
</script>

</body>

</html>