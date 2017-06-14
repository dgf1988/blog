<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/14
 * Time: 20:31
 */

require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/post/post.class.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";


session_start();
if (empty($_SESSION['user'])) {
    die('没有登录 。');
}
if (empty($_POST['title'])) {
    die('没有标题 。');
}
if (empty($_POST['text'])) {
    die('没有内容 。');
}

$user = $_SESSION['user'];

$ip = getip();
$username = $user[USER_USERNAME];
$title = $_POST['title'];
$text = $_POST['text'];

$dbh = new_pdo();
new Post($dbh);
$id = Post::add(array(POST_IP=>ipton(getip()),
    POST_USER=>$user[USER_USERNAME],
    POST_TITLE=>$_POST['title'],
    POST_TEXT=>$_POST['text']));
if ($id > 0 ) {
    header('location: /post/');
} else {
    var_dump($dbh->errorInfo());
}