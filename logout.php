<?php
/**
 * Created by PhpStorm.
 * User: theliberty
 * Date: 08/07/2017
 * Time: 14:45
 */
session_start();
$_SESSION = [];
session_destroy();
header("Location: index.php");