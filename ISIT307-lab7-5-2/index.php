<?php
require_once("scripts/db.php");
$db = connect_db();
$sql = "SELECT * FROM MEMBERS";
$result = mysqli_query($db,$sql);
$curDate = date("Y-m-d");
while($row = mysqli_fetch_assoc($result)){
    if($row['debt'] > 0) {
        $datetime1 = new DateTime($curDate);
        $datetime2 = new DateTime($row['datedue']);
        $interval = $datetime1->diff($datetime2);
        if($interval->format('%R%a') < 0) {
            $pos = $interval->format('%R%a');
            $pos = $pos * -1;
            $to = $row['email'];
            $subject = "Your Debt is Overdue. Please pay now!";
            $message = "Dear " . $row['fname'] . "," . "<br />Your debt of $" . $row['debt'] . " is now overdue by " . $pos . " days.<br />To avoid any addition fees, please pay as soon as possible. <br />";
            $message = $message . "<br /> Kind regards<br /> Date Recovery Team";
            $headers = 'From: admin@debts.com' . "\r\n" .
                'Reply-To: admin@debts.com' . "\r\n";
            mail($to, $subject, $message, $headers);
        }
    }
}
?>