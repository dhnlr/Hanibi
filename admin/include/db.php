<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 01/07/2017
 * Time: 8:00
 */
$handle = fopen('config.txt',"r");
$db = fgetcsv($handle,'0',',');
$dbc = mysqli_connect("$data[0]", "$data[1]", "$data[2]", "$data[3]");
if (!$dbc) {
    die($dbc);
}
?>