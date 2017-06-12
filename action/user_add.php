<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/12
 * Time: 22:49
 */
require_once dirname(__FILE__)."/../config.php";
require_once dirname(__FILE__)."/../lib/user.php";
require_once dirname(__FILE__)."/../lib/sql.php";

$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];

$db = mysql_open();

