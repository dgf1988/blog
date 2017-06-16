<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/15
 * Time: 21:31
 */

require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/post/post.class.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";

session_start();

if (empty($_SESSION['user'])) {
    Out('没有登录。');
}

if (empty($_POST)) {
    Out('方法不正确。');
}

$id = $_POST['id'];
$title = $_POST['title'];
$text = $_POST['text'];

if ($id <= 0 or empty($title) or empty($text)) {
    Out('提交错误。');
}

try{
    $dbh = new_pdo();
    new Post($dbh);
    Post::set($id, POST_TITLE, $title);
    Post::set($id, POST_TEXT, $text);
    header('location: /post/edit.php?id='.$id);
}catch (PDOException $e) {
    Out(FormatException($e));
}