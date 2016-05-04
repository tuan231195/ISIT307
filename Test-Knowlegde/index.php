<html>
<body>
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

if (isset($_POST["submit"]))
{
    var_dump($_POST["name"]);
}
?>

<form action="" method="POST">
    <input type = "text" name = "name[]" value = "<?php echo ifsetor($_POST["name"][0])?>"/>
    <input type = "text" name = "name[]" value = "<?php echo ifsetor($_POST["name"][1])?>"/>
    <input type = "submit" name = "submit" value = "Submit"/>
</form>
</body>

</html>