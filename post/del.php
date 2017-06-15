<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/15
 * Time: 16:32
 */

require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/post/post.class.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";


session_start();

if (empty($_POST)) {
    Out('提交方式不对。');
}


if (empty($_SESSION['user'])) {
    Out('没有登录 。');
}

if (empty($_POST['id'])) {
    Out('没有参数 。');
}

$id = $_POST['id'];
try{
    $pdh = new_pdo();
    new Post($pdh);
    $count = Post::del($id);
    if ($count > 0 ) {
        Out('删除成功。');
    }    else {
        Out('删除失败。');
    }

}catch (PDOException $e) {
    Out(FormatException($e));
}

