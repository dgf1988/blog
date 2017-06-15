<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 20:37
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


if (empty($_POST['name']) or empty($_POST['password']) ) {
    die('不能为空。');
} else {
    $name = $_POST['name'];
    $password = $_POST['password'];
    try{
        new User(new_pdo());
        $user = User::find_by_name($name);
        if (empty($user)) {
            Out('用户不存在');
        }
        if ($user[USER_KEYCODE] != User::keycode($name, $password)) {
            Out('密码错误');
        }
        $_SESSION['id'] = $user[USER_ID];
        $_SESSION['name'] = $user[USER_USERNAME];
        $_SESSION['user'] = $user;
        header('Location: /user/');
    }catch (PDOException $e) {
        Out( FormatException($e));
    }
}