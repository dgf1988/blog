<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_TITLE.' - '.$user[USER_USERNAME]; ?></title>
    <link href="/css/base.css" rel="stylesheet" style="text/css" />
    <link href="/css/user_info_table.css" rel="stylesheet" style="text/css" />
</head>
<body>
<header>
    <h1><a href="/"><?php echo SITE_TITLE ?></a></h1>
    <nav>
        <a href="/">首页</a>
        <a href="/post/">日记</a>
        <a href="/user/"><?PHP echo $user[USER_USERNAME]; ?></a>
    </nav>
</header>
<hr/>
<div>
    <table class="user_info_table">
        <tr><th>ID</th><td><?php echo $user[USER_ID] ?></td></tr>
        <tr><th>用户名</th><td><?php echo $user[USER_USERNAME] ?></td></tr>
        <tr><th>邮箱</th><td><?php echo $user[USER_EMAIL] ?></td></tr>
        <tr><th>注册时间</th><td><?php echo $user[USER_ADDTIME] ?></td></tr>
        <tr><th>注册地址</th><td><?php echo ntoip($user[USER_ADDIP]) ?></td></tr>
    </table>
    <a style="display: block;font-size: 18px;" href="logout.php" title="退出">退出</a>
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