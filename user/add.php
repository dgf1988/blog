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

if (!empty($_SESSION['user'])) {
    die('已经登录');
}

$ip = getip();
$name = $_POST["name"];
$password = $_POST["password"];
$email = $_POST["email"];

try{
    new User(new_pdo());
    $id = User::add(array('addip'=>ipton($ip), 'username'=>$name, 'keycode'=>User::keycode($name, $password), 'email'=>$email));
    if (empty($id)) {
        die("注册失败");
    }
}catch (PDOException $e ) {
    die( $e->getMessage() );
}
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>注册</title>
</head>
<body>
<a href="/user/?id=<?php echo $id ?>">注册成功</a>
<hr/>
</body>
</html>

