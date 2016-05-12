<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 6/04/2016
 * Time: 4:17 PM
 */
function connect_db ()
{
    $db = mysqli_connect("localhost", "root", "dotuan2311", "local-debt");
    if ($db->connect_error) {
        die("no connection");
    }
    return $db;
}
?>