<html>
<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 4/05/2016
 * Time: 7:58 PM
 */

session_start();


if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}

require_once("util/Db_Handler.php");
$dbHandler = new DBHandler();

$borrowedBooks = $dbHandler->prepareQuery("SELECT * FROM (borrow NATURAL JOIN book) WHERE member_id = ? ORDER BY due_date asc", "s", array($_SESSION['userid']));

function ifsetor(&$variable, $default = null)
{
    if (isset($variable)) {
        $tmp = $variable;
    } else {
        $tmp = $default;
    }
    return $tmp;
}

?>


<?php
require_once ('header.php');
?>

<body>

<div class="container">
    <h3>Your user id: <?php echo $_SESSION['userid'] ?></h3>
    <a class="btn btn-primary pull-right" href="search.php">Go to search <span
            class="glyphicon glyphicon-chevron-right"></span></a>
    <div class="clearfix"/>
    <br/>
    <br/>

    <div class="page-header">
        <h4 class = "text-danger">Items on hold</h4>
    </div>
    <div class="panel-group">
        <?php foreach ($borrowedBooks as $book): ?>
            <div class="book panel panel-default <?php if (strtotime($book["due_date"]) < strtotime("now")) echo 'overdue'?>">
                <div class="panel-heading"><h5>Book number : <?php echo $book["book_number"] ?></h5></div>
                <div class="panel-body">
                    <p>
                     <b>Title: </b><?php echo $book["title"] ?>
                    </p>
                    <p>
                        <b>Description: </b><?php echo $book["description"] ?>
                    </p>
                    <p>
                        <b>Due date: </b><?php echo $book["due_date"]?>
                    </p>
                    <?php if (strtotime($book["due_date"]) < strtotime("now")) echo "<p class = 'text-danger'>Item overdue</p>"?>
                </div>
            </div>
        <?php endforeach ?>
    </div>

</div>
</body>
</html>

