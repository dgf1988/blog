<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 16:59
 */
require_once dirname(__FILE__) . "/../config.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";
require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/tool.php";



$id = 1;
if (isset($_GET["id"])) {
    $id = $_GET['id'];
}

try{
    $pdo = newPdo();
    $user = User::Get($pdo, $id);
    print_r($user);
}catch (PDOException $e ) {
    echo $e->getMessage();
}
