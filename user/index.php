<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 16:59
 */
require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";


session_start();

if (empty($_SESSION['user'])) {
    require_once 'html/login_register.php';
    exit();
}

$user = $_SESSION['user'];

require_once 'html/user_info.php';
