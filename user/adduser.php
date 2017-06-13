<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/12
 * Time: 22:49
 */
require_once dirname(__FILE__) . "/../config.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";
require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/tool.php";



$ip = tool_getip();
$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];

try{
    $pdo = newPdo();
    $id = User::Add($pdo, array('addip'=>ipton($ip), 'username'=>$name, 'keycode'=>md5($name.$password), 'email'=>$email));
    echo "the id is ".$id;
}catch (PDOException $e ) {
    echo $e->getMessage();
}
