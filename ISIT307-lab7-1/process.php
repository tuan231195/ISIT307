<?php
$title = "Process";
$page = "";
session_start();
require_once('include/header.php');
require_once('include/navbar.php');


// A function that will accept and clean up CC numbers
function standardize_credit($num)
{
// Remove all non-digits from the string
    return preg_replace('/[^0-9]/', '', $num);
}

// A function to check the validity of a CC number
// It must be provided with the number itself, as well as
// a character specifying the type of CC:
// m = Mastercard, v = Visa, d = Discover, a = American Express
function validate_credit($num, $type)
{
// First perform the CC specific tests:
// Store a few evaluations we will need often:
    $len = strlen($num);
    $d2 = substr($num, 0, 2);
// If Visa must start with a 4, and be 13 or 16 digits long:
    if ((($type == 'v') && (($num{0} != 4) ||
                !(($len == 13) || ($len == 16)))) ||
// If Mastercard, start with 51-56, and be 16 digits long:
        (($type == 'm') && (($d2 < 51) ||
                ($d2 > 56) || ($len != 16))) ||
// If American Express, start with 34 or 37, 15 digits long:
        (($type == 'a') && (!(($d2 == 34) || ($d2 == 37)) || ($len != 15))) ||
// If Discover: start with 6011 and 16 digits long
        (($type == 'd') && ((substr($num, 0, 4) != 6011) || ($len != 16)))
    ) {
// Invalid card:
        return false;
    }
// If we are still here, then time to manipulate and do the Mod 10 // algorithm. First break the number into an array of characters:
    $digits = str_split($num);
// Now reverse it:
    $digits = array_reverse($digits);
// Double every other digit:
    foreach (range(1, count($digits) - 1, 2) as $x) {
        $digits[$x] *= 2;
// If this is now over 10, go ahead and add its digits, easier since
//// the first digit will always be 1
        if ($digits[$x] > 9) {
            $digits[$x] = ($digits[$x] - 10) + 1;
        }
    }
// Now, add all this values together to get the checksum
    $checksum = array_sum($digits);
// If this was divisible by 10, then true, else it's invalid
    return (($checksum % 10) == 0) ? true : false;
}

?>
<div class="container">
    <div class = "page-header">
        <h3>Thank you</h3>
    </div>
    <?php
    // If this session is not valid, say so:
    if (!isset($_SESSION['validsubmit']) || !$_SESSION['validsubmit']) {
        echo "ERROR:  Invalid form submission, or form already submitted!";
    } else {
        if (isset($_POST['card_number']) && isset($_POST['type']) && validate_credit(standardize_credit($_POST['card_number']), $_POST['type'])) {
            // This was valid, so first of all clear the validity:
            $_SESSION['validsubmit'] = false;
            echo "Your card is ok";
        } else {
            echo "Invalid card";
        }
    }

    ?>

</div>

