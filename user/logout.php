<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 21:37
 */


require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";

session_start();


unset($_SESSION);
session_destroy();

header('Location: /user/');