<html>
<head>
    <title>Directory Traverser</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
</head>
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

?>
<body>
    <div class = "container">
        <div class = "page-header">
            <h3 class = "text-danger">Directory Traverser</h3>
        </div>
        <form method = "get" action = "" id = "form">
            <div class = "form-group">
                <label for = "directory-field">Enter the directory:</label>
                <div class = "input-group">
                    <input type = "text" class = "form-control" name = "path" id = "directory-field" value = "<?php echo htmlspecialchars(ifsetor($_GET['path']))?>">
                    <span class = "input-group-addon" onclick = '$("#form").submit()'>Go</span>
                </div>
            </div>
        </form>
        <div class = "page-header">
            <h3 class = "text-danger">Content of the directory</h3>
        </div>
        <div class = "files">
            <table class = "table table-striped">
                <tr>
                    <th>File name</th>
                </tr>
                <?php if (isset($_GET["path"]) && !empty(trim($_GET["path"]))):
                    $dir = trim($_GET["path"]);
                    $d = @dir($dir);
                    if ($d)
                    {
                        while (false !== ($file = $d->read()))
                        {
                            echo "<tr>";
                            $realpath = realpath($dir. "/" . $file );
                            if (is_dir($realpath))
                                echo "<td><a href = 'index.php?path=$realpath'>$file</a></td>";
                            else
                            {
                                echo "<td>$file</td>";
                            }
                            echo "</tr>";
                        }
                    }
                endif;?>
            </table>
        </div>
    </div>

</body>
</html>