<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title><?PHP echo SITE_TITLE.' - 日志' ?></title>
    <link href="/css/base.css" rel="stylesheet" style="text/css" >
    <link href="/css/post_list.css" rel="stylesheet" style="text/css" >
    <style>
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
            width: 500px;
        }
        body  > div > form > table td textarea {
            width: 500px;
            resize: none;
            height: 150px;
            padding: 1px;
        }
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
            <a href="/user/"><?PHP echo $user[USER_USERNAME]; ?></a>
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
                <tr>
                <th></th>
                <td><input type="submit" value="提交"></td>
</tr>

</table>
                
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