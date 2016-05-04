<?php
header("Content-type: text/xml");
$handle = fopen('directory.txt', 'r');
$num_documents = 5;
$count = 0;
//get the header

fgets($handle);
$response = "<?xml version='1.0' encoding='UTF-8'?><cars>";
$exact = false;
$first = 0;
$page = 0;
$added = 0;
if (isset($_GET['exact_match']))
{
    $exact = true;
}
if (isset($_GET['first']))
{
    $page = is_numeric($_GET['first']) ? $_GET['first'] : 0;
    $first = $page  * $num_documents;
}
while (!feof($handle)) {
    $line = fgets($handle);
    if ($line) {
        $array = json_decode($line, true);
        if (isset($_GET['plate_number'])) {
            $plate = (int)($_GET['plate_number']);
            if (!$exact)
            {
                if (preg_match("/^$plate/", $array["plate_number"])) {
                    $count++;
                    //skip some cars
                    if ($first > 0)
                    {
                        $first --;
                        continue;
                    }
                    else{
                        if ($added < $num_documents)
                            addCar($response, $array);
                    }

                }
            }
            else{
                if ($plate == $array["plate_number"])
                {
                    addCar($response, $array);
                    break;
                }
            }
        } else {
            $count++;
            if ($first > 0)
            {
                $first --;
                continue;
            }
            else{
                if ($added < $num_documents)
                    addCar($response, $array);
            }
        }
    }
}
if (!$exact)
{
    if (isset($plate))
        $response.= "<query>$plate</query>";
    $response.= "<cur>$page</cur>";
    $response.= "<total>".ceil($count/$num_documents) ."</total>";
}
$response .= "</cars>";

fclose($handle);
echo $response;

function addCar(&$response, $array)
{
    global $added;
    $added ++;
    $response .= "<car>";
    $response .= "<plate_number>";
    $response .= $array["plate_number"];
    $response .= "</plate_number>";
    $response .= "<model>";
    $response .= $array["model"];
    $response .= "</model>";
    $response .= "<manu>";
    $response .= $array["manu"];
    $response .= "</manu>";
    $response .= "<price>";
    $response .= $array["price"];
    $response .= "</price>";
    $response .= "<names>";
    for ($i = 0; $i < count($array["name"]); $i++)
    {
        $response .= "<name>";
        $response .= $array["name"][$i];
        $response .= "</name>";
    }
    $response .= "</names>";
    $response .= "<email>";
    $response .= $array["email"];
    $response .= "</email>";
    $response .= "<image>";
    $response .= $array["image"];
    $response .= "</image>";
    $response .= "<phone>";
    $response .= $array["phone"];
    $response .= "</phone>";
    $response .= "</car>";
}


