<?php
session_start();
require_once("util/Db_Handler.php");

$dbHandler = new DBHandler();
function ifsetor(&$variable, $default = null)
{
    if (isset($variable)) {
        $tmp = $variable;
    } else {
        $tmp = $default;
    }
    return $tmp;
}


if (isset($_SESSION['userid']))
{
    header('Location: index.php');
}

if (isset($_POST['go']))
{
    if (empty(trim($_POST['userid'])))
    {
        $err_msg = "User id cannot be empty";
    }
    else
    {
        $userid = trim($_POST['userid']);
    }

    if (empty(trim($_POST['password'])))
    {
        $err_msg = "Password cannot be empty";
    }
    else{
        $password = trim($_POST['password']);
    }

    if (isset($userid) && isset($password))
    {
        $cnt = $dbHandler->prepareCountQuery("SELECT COUNT(*) FROM member WHERE member_id = ? && password = ?", "ss", array($userid, $password));
        if ($cnt === 0)
        {
            $err_msg = "Incorrect username or password";
        }
        else{
            $_SESSION['userid'] = $userid;
            header("Location: index.php");
        }
    }
}

?>
<!DOCTYPE html>
<html>

<?php
require_once ('header.php');
?>


<section class="container">
    <section class="login-form">
        <div class="panel panel-default">
            <div class="panel-heading">USER LOGIN</div>
            <div class="panel-body">
                <form method="post" action="" role="login">

                    <input type="email" name = "userid" class="form-control input-lg" placeholder="User Id" required>
                    <input type="password" name = "password" class="form-control input-lg" placeholder="Password" required>
                    <span class = "text-danger <?php if (isset($err_msg)) echo 'error' ?>"><?php echo ifsetor($err_msg)?></span>
                    <button type="submit" name="go" class="btn btn-lg btn-info btn-block">SIGN IN NOW</button>
                </form>
            </div>
        </div>

    </section>
</section>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>