
<?php
/**
 * Created by PhpStorm.
 * User: tuannguyen
 * Date: 4/05/2016
 * Time: 3:10 PM
 */
function standardize($input)
{
    return preg_replace('/[^0-9]/', '', $input);
}

function ifsetor(&$variable, $default = null)
{
    if (isset($variable)) {
        $tmp = $variable;
    } else {
        $tmp = $default;
    }
    return $tmp;
}

function romanize($num)
{
// Make sure that we only use the integer portion of the value
    $n = intval($num);
    $result = '';
    // Declare a lookup array that we will use to traverse the number:
    $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    foreach ($lookup as $roman => $value) {
    // Determine the number of matches:
        $matches = intval($n / $value);
    // Store that many characters:
        $result .= str_repeat($roman, $matches);
    // Substract that from the number
        $n = $n % $value;
    }
    // The Roman numeral should be built, return it
    return $result;
}


if (isset($_POST['submit'])) {
    $number = trim($_POST['number']);
    if (strlen($number) == 0) {
        $error = "You must enter something...";
    } else {
        $number = standardize($number);
        if (strlen($number) == 0) {
            $error = "You must enter at least one digit...";
        }
        else{
            $result = romanize($number);
        }

    }

}
?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <style>
        .error {
            margin-top: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h3>Roman number converter</h3>
    </div>
    <form method="POST" action="">
        <div class="form-group">
            <label for "number">Enter your number:</label>
            <input type="text" class="form-control" id="number" name="number" value = "<?php echo ifsetor($number)?>"/>
            <span class="text-danger <?php if (isset($error)) echo 'error' ?>"><?php echo ifsetor($error) ?></span>
        </div>
        <div class="form-group">
            <label for "result">Your result</label>
            <input type="text" class="form-control" id="result" name="result" value="<?php echo ifsetor($result) ?>"
                   readonly/>
        </div>
        <button name=" submit" type="submit" class='btn btn-primary'>Convert</button>
    </form>
</div>


</body>
</html>

