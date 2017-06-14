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

$user = empty($_SESSION['user'])? null : $_SESSION['user'];

?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <?PHP if (empty($user)) {
        echo '<title>非常落伍 - 登录</title>';
    } else {
        echo '<title>非常落伍 - '.$user[USER_USERNAME].'</title>';
    } ?>
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
        body div table {
            display: inline-block;
        }
        body div table tr {
            display: block;
            margin: 5px 5px ;
        }
        body div table th {
            width: 100px;
        }
        body > div > a {
            display: block;
            width: 50px;
            margin: auto;
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
    <?PHP
        if (empty($user)) {
            $html = <<<eof
        <form method='post' action='/user/add.php'>
            <label>用户名：<input name='name'/></label>
            <label>密码：<input name='password' type='password'/></label>
            <label>电邮：<input name='email'/></label>
            <input type='submit' value="注册">
        </form>
        <hr/>
        <form method='post' action='/user/login.php'>
            <label>用户名：<input name='name'/></label>
            <label>密码：<input name='password' type='password'/></label>
            <input type='submit' value="登录">
        </form>
eof;
            echo $html;
        } else {
            echo "<table>";
            echo "<tr><th>ID</th><td>{$user[USER_ID]}</td></tr>";
            echo "<tr><th>NAME</th><td>{$user[USER_USERNAME]}</td></tr>";
            echo "<tr><th>EMAIL</th><td>{$user[USER_EMAIL]}</td></tr>";
            echo "<tr><th>ADDTIME</th><td>{$user[USER_ADDTIME]}</td></tr>";
            echo "<tr><th>ADDIP</th><td>".ntoip($user[USER_ADDIP])."</td></tr>";
            echo "</table>";
            echo '<a href="logout.php" title="退出">退出</a>';
        }
    ?>
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
