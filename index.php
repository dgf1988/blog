<?php
    require_once "config.php";
    require_once "lib/sql.php";
    require_once "lib/user/user.class.php";
    try{
        $pdo = newPdo();
        $res = User::CreateTableIfNotExists($pdo);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>这是一个测试页</title>
</head>
<body>
    <div><?php echo $res ?></div>
    <form method="post" action="user/adduser.php">
        <label>用户名：<input name="name"/></label>
        <label>密码：<input name="password" type="password"/></label>
        <label>电邮：<input name="email"/></label>
        <input type="submit" value="提交">
    </form>
</body>
</html>
