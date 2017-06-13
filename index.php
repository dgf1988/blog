<?php
    require_once "config.php";
    require_once "lib/sql.php";
require_once "lib/user/user.class.php";
require_once "lib/post/post.class.php";

    try{
        $pdo = new_pdo();
        new User($pdo);
        new Post($pdo);
        User::create_table_if_not_exists();
        Post::create_table_if_not_exists();

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
    <header>
        <nav>
            <label><a href="/user/">用户</a></label>
        </nav>
    </header>
</body>
</html>
