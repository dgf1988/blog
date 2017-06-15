<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_TITLE.' - 用户' ?></title>
    <link href="/css/base.css" rel="stylesheet" style="text/css" />
    <link href="/css/login_table.css" rel="stylesheet" style="text/css" />
</head>
<body>

<header>
    <h1><a href="/"><?php echo SITE_TITLE ?></a></h1>
    <nav>
        <a href="/">首页</a>
        <a href="/post/">日记</a>
        <a href="/user/">登录</a>
    </nav>
</header>

<hr/>

<div>
    <form method='post' action='/user/add.php'>
        <table class="login_talbe">
            <caption>注册</caption>
            <tr>
                <th>用户名</th>
                <td><input name='name'/></td>
            </tr>
            <tr>
                <th>密码</th>
                <td><input name='password' type='password'/></td>
            </tr>
            <tr>
                <th>邮箱</th>
                <td><input name='email'/></td>
            </tr>
            <tr>
                <th></th>
                <td><input class="button" type='submit' value="注册"></td>
            </tr>
        </table>
    </form>

    <form method='post' action='/user/login.php'>
        <table class="login_talbe">
            <caption>登录</caption>
            <tr>
                <th>用户名</th>
                <td><input name='name'/></td>
            </tr>
            <tr>
                <th>密码</th>
                <td><input name='password' type='password'/></td>
            </tr>
            <tr>
                <th></th>
                <td><input type='submit' value="登录"></td>
            </tr>
        </table>
    </form>
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