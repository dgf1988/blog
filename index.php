<?php

require_once "lib/sql.php";
require_once "lib/function.php";
require_once "lib/user/user.class.php";
require_once "lib/post/post.class.php";

session_start();
$user = empty($_SESSION['user'])?NULL:$_SESSION['user'];

try{
    $pdo = new_pdo();
    new User($pdo);
    new Post($pdo);
    User::create_table_if_not_exists();
    Post::create_table_if_not_exists();
    $postlist = Post::list();
} catch(PDOException $e) {
    Out($e->getMessage());
}
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE ?></title>
    <link href="/css/base.css" rel="stylesheet" style="text/css" />
    <link href="/css/post_list.css" rel="stylesheet" style="text/css" />
    <style>

    </style>
</head>
<body>
    <header>
        <h1><a href="/"><?php echo SITE_TITLE ?></a></h1>
        <nav>
            <a href="/">首页</a>
            <a href="/post/">日记</a>
            <?PHP if (empty($user)) { ?>
                <a href="/user/">登录</a>
            <?PHP } else { ?>
                <a href="/user/?id=<?PHP echo $user[USER_ID]; ?>"><?PHP echo $user[USER_USERNAME]; ?></a>
            <?PHP } ?>
        </nav>
    </header>
    <hr/>
    <div>
        <ol class="post_list">
            <?PHP foreach ($postlist as $post) { ?>
            <li>
                <h4><a href="/post/?id=<?PHP echo $post[POST_ID]; ?>"><?PHP echo $post[POST_TITLE]; ?></a></h4>
                <time><?PHP echo $post[POST_TIME]; ?></time>
            </li>
            <?PHP } ?>
        </ol>
    </div>
    <hr/>
    <footer>
        <label>©2017 丁国锋</label>
        <a href="http://www.miitbeian.gov.cn">闽ICP备14014166号-1</a>
        <a href="mailto:dgf1988@qq.com">dgf1988@qq.com</a>
        <div style="width:300px;margin:0 auto; padding:20px 0;">
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=35098202000014" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img src="/beian.png" style="float:left;"/><p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">闽公网安备 35098202000014号</p></a>
        </div>
    </footer>
</body>
</html>
