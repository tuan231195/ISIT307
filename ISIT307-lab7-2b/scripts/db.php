<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 6/04/2016
 * Time: 4:17 PM
 */

  function connect_db ()
  {
      $db = mysqli_connect("localhost", "root", "dotuan2311", "ISIT307-lab7-exam");
      if ($db->connect_error) {
          die("no connection");
      }

      return $db;
  }

    function get_results($sql){

        $db = connect_db();
        $result = mysqli_query($db, $sql);

        return $result;
    }

    function check_pass($result){
        $found = false;

        while($row = mysqli_fetch_assoc($result)){
            if($row['status'] == "P"){
                $found = true;
                break;
            }

        }
        return $found;
    }

?>