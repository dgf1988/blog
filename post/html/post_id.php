<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title><?PHP echo SITE_TITLE.' - '.$post[POST_TITLE]; ?></title>
    <link href="/css/base.css" rel="stylesheet" style="text/css" >
    <style>
        article {
            display: inline-block;
            width: 600px;

        }
        article header {
            margin: 10px;
        }
        article h4 {
            font-size: 22px;

        }
        article > div {
            font-size: 18px;
            text-align: left;
        }
        article > div  {
            text-indent: 2em;
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
    <article>
        <header>
            <h4><?PHP echo $post[POST_TITLE] ?></h4>
            <time><?PHP echo $post[POST_TIME] ?></time>
            <label>@<?PHP echo $post[POST_USER] ?></label>
        </header>
        <div>
            <?PHP echo $post[POST_TEXT] ?>
        </div>
        <?PHP if (!empty($user) and $user[USER_USERNAME] == $post[POST_USER]) { ?>
        <footer>
            <form action="/post/del.php" method="post">
                <input type="button" onclick="location='/post/edit/?id=<?PHP echo $post[POST_ID] ?>'" value="编辑">
                <input type="hidden" name="id" value="<?PHP echo $post[POST_ID] ?>">
                <input type="submit" value="删除">
            </form>
        </footer>
        <?PHP } ?>
    </article>
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