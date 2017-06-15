<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_TITLE ?></title>
    <link href="/css/base.css" rel="stylesheet" style="text/css" >
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
        <a href="/user/"><?PHP echo $user[USER_USERNAME]; ?></a>
        <?PHP } ?>
    </nav>
</header>
<hr/>
<div style="text-align: center;font-size: 22px; color: #F00;">
    <p><?php echo $Message; ?></p>

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