<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/15
 * Time: 21:23
 */

require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/post/post.class.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";

session_start();

if (empty($_SESSION['user'])) {
    Out('没有登录。');
}

if (empty($_GET['id'])) {
    Out('文章不存在。');
}

$id = $_GET['id'];

try{
    $dbh = new_pdo();
    new Post($dbh);
    $post = Post::get($id);
    if (empty($post)) {
        Out('找不到文章。');
    }
    if ($post[POST_USER] != $_SESSION['user'][USER_USERNAME]) {
        Out('文章不是你发的。');
    }
    $user = $_SESSION['user'];
    include_once dirname(__FILE__).'/../post/html/post_edit.php';
}catch (PDOException $e) {
    Out(FormatException($e));
}