<?php

require_once 'config.php';
require_once dirname(__FILE__)."/lib/sql.php";
require_once dirname(__FILE__)."/lib/function.php";
require_once dirname(__FILE__)."/lib/user/user.class.php";
require_once dirname(__FILE__)."/lib/post/post.class.php";

session_start();
$user = empty($_SESSION['user'])?NULL:$_SESSION['user'];

try{
    $pdo = new_pdo();
    new User($pdo);
    new Post($pdo);
    $postlist = Post::many();
} catch(PDOException $e) {
    Out($e->getMessage());
}

include_once 'html/index.php';