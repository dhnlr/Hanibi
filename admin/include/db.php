<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 01/07/2017
 * Time: 8:00
 */
$dbc = mysqli_connect("localhost", "root", "", "CMS", "3306");
if (!$dbc) {
    die($dbc);
}
?>