<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 22:43
 */

require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/post/post.class.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";


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
    die($e->getMessage());
}

?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>非常落伍</title>
    <style>
        body {
            font-family: "Microsoft YaHei UI";
            text-align: center;
        }
        body header h1 a{
            text-decoration: none;
            color: black;
        }
        body header nav a{
            display: inline-block;
            font-size: 20px;
            margin: 0 10px;
        }
        body  > div > form > table {
            display: inline-block;
        }
        body  > div > form > table th {
            width: 60px;
        }
        body  > div > form > table td {
            text-align: left;
        }
        body  > div > form > table td input {
            width: 400px;
        }
        body  > div > form > table td textarea {
            width: 400px;
            resize: none;
            height: 100px;
            padding: 1px;
        }
        body ol {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        body ol li{
            margin: 10px;
        }
        body ol h4{
            font-size: 18px;
            margin: 0;
        }
        body ol time{
            font-size: 14px;
        }
        body footer label{
            font-size: 14px;
        }
        body footer a{
            display: inline-block;
            font-size: 14px;
            margin: 0 15px;
        }
    </style>
</head>
<body>
<header>
    <h1><a href="/">非常落伍</a></h1>
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
    <ol>
        <?PHP foreach ($postlist as $post) { ?>
            <li>
                <h4><a href="/post/?id=<?PHP echo $post[POST_ID]; ?>"><?PHP echo $post[POST_TITLE]; ?></a></h4>
                <time><?PHP echo $post[POST_TIME]; ?></time>
            </li>
        <?PHP } ?>
    </ol>
    <?PHP if (!empty($user)) {
        $html = <<<eof
            <form method="post" action="add.php"> 
                <table>
                <tr>
                <th>标题</th><td><input class="input" name="title" ></td>
</tr>
                <tr>
                <th>内容</th><td><textarea class="input" name="text"></textarea></td>
</tr>
</table>
                <input type="submit" value="提交">
            </form>
eof;
        echo $html;
    } ?>
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