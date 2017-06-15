<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/12
 * Time: 22:49
 */




require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";


session_start();

if (empty($_POST)) {
    Out('提交方式不对。');
}

if (!empty($_SESSION['user'])) {
    Out('已经登录');
}

$ip = getip();
$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];

if (empty($ip) or empty($name) or empty($password) or empty($email)) {
    Out('不能为空。');
}

$id = 0;
try{
    new User(new_pdo());
    $id = User::add(array('addip'=>ipton($ip), 'username'=>$name, 'keycode'=>User::keycode($name, $password), 'email'=>$email));
    if (empty($id)) {
        Out("注册失败");
    }
}catch (PDOException $e ) {
    Out( FormatException($e) );
}

Out('注册成功，ID='.$id);

