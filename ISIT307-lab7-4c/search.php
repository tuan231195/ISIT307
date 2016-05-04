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

function ifsetor(&$variable, $default = null)
{
    if (isset($variable)) {
        $tmp = $variable;
    } else {
        $tmp = $default;
    }
    return $tmp;
}

if (isset($_GET['search']))
{
    $keyword = trim($_GET['keyword']);
    if (strlen($keyword) == 0)
    {
        $err_msg = "Keyword must not be empty";
    }
    else{
        $results = $dbHandler->prepareQuery("SELECT distinct book.book_number as book_number, title, description, borrow.member_id from (book LEFT JOIN borrow ON book.book_number = borrow.book_number) where title LIKE ? OR book.book_number LIKE ?", "ss", array("%$keyword%", "%$keyword%"));
    }
}

?>



<?php
require_once ('header.php');
?>


<body>
    <div class = "container">
        <h3>Your user id: <?php echo $_SESSION['userid'] ?></h3>
        <br/>
        <a class = "btn btn-primary" href = "index.php">Back to Home <span class = "glyphicon glyphicon-chevron-left"></span></a>
        <br/>
        <br/>
        <div class = "page-header">
            <h4 class = "text-danger">Search for items</h4>
        </div>
        <form action = "" method = "GET">
            <div class = "form-group">
                <label for = "book">Book number</label>
                <input type = 'text' name = "keyword" class = "form-control" placeholder = "Keyword"/>
                <div class = "text-danger <?php if (isset($err_msg)) echo 'error' ?>"><?php echo ifsetor($err_msg)?></div>
            </div>
            <input type = "submit" name = "search" class = "btn btn-info" value = "Search"/>
        </form>

        <?php if (isset($results)):?>
            <div class = "panel-group">
                <div class = "page-header">
                    <h4 class = "text-danger"> Search results</h4>
                </div>
                <?php foreach ($results as $book):?>

                    <div class="book panel panel-default">
                        <div class="panel-heading"><h5>Book number : <?php echo $book["book_number"] ?></h5></div>
                        <div class="panel-body">
                            <p>
                                <b>Title: </b><?php echo $book["title"] ?>
                            </p>
                            <p>
                                <b>Description: </b><?php echo $book["description"] ?>
                            </p>
                            <p>
                                <?php if (!empty($book['member_id'])): ?>
                                    <button class = "btn btn-primary pull-right" disabled>Item not available</button>
                                <?php else:?>
                                    <button class = "btn btn-primary pull-right borrow-btn" data-item = "<?php echo $book["book_number"] ?>">Borrow</button>
                                <?php endif;?>
                                <div class = "clearfix"/>
                            </p>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>

    </div>
    <script type = "text/javascript">
        $(".borrow-btn").click(function(){
            var btn = $(this);
            $.post("borrow.php", {"book_number": $(this).data('item')}, function(result){
                result = JSON.parse(result);
                if (result.code == 1)
                {
                    alert("Book borrowed successfully");
                    btn.text('Item not available');
                    btn.prop("disabled", true);
                }
                else{
                    alert("Failed to borrow the book");
                }
            }) ;

        });
    </script>
</body>
</html>

