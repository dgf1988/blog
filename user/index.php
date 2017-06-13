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

$id = 0;
if (isset($_GET["id"])) {
    $id = $_GET['id'];
} else if (!empty($_SESSION['user'])) {
    header("Location: /user/?id={$_SESSION['user']['id']}");
    exit();
}

try{
    new User(new_pdo());
    $user = null;
    if ($id > 0) {
        $user = User::get($id);
        if (is_null($user)) {
            die("找不到人。");
        }
    }

}catch (PDOException $e ) {
    echo $e->getMessage();
}
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>用户</title>
</head>
<body>
<?php if (!isset($user) or empty($user)) { ?>

    <form method="post" action="/user/add.php">
        <label>用户名：<input name="name"/></label>
        <label>密码：<input name="password" type="password"/></label>
        <label>电邮：<input name="email"/></label>
        <input type="submit" value="提交">
    </form>
    <hr/>
    <form method="post" action="/user/login.php">
        <label>用户名：<input name="name"/></label>
        <label>密码：<input name="password" type="password"/></label>
        <input type="submit" value="提交">
    </form>

<?php } else { ?>

    <table>
        <tr>
            <th>id</th>
            <td><?php echo $user[USER_ID] ?></td>
        </tr>
        <tr>
            <th>addtime</th>
            <td><?php echo $user[USER_ADDTIME] ?></td>
        </tr>
        <tr>
            <th>addip</th>
            <td><?php echo ntoip($user[USER_ADDIP]) ?></td>
        </tr>
        <tr>
            <th>username</th>
            <td><?php echo $user[USER_USERNAME] ?></td>
        </tr>
        <tr>
            <th>email</th>
            <td><?php echo $user[USER_EMAIL] ?></td>
        </tr>
        <?php if (!empty($_SESSION['user'])) { ?>
        <tr>
            <th>操作</th>
            <td><a href="/user/logout.php" >退出</a></td>
        </tr>
        <?php } ?>
    </table>
    <form action="/post/" method="post">
        <ol style="list-style: none;" >
            <li><input name="title" ></li>
            <li><textarea name="text"></textarea></li>
            <li><input type="submit" value="提交"></li>
        </ol>
    </form>
<?php } ?>
</body>
</html>
