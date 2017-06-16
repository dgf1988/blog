<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 22:43
 */

require_once dirname(__FILE__) . "/../lib/sql.php";
require_once dirname(__FILE__) . "/../lib/function.php";
require_once dirname(__FILE__) . "/../lib/post/post.class.php";
require_once dirname(__FILE__) . "/../lib/user/user.class.php";


session_start();
$user = empty($_SESSION['user'])?NULL:$_SESSION['user'];

try{
    $pdo = new_pdo();
    new Post($pdo);
    if (empty($_GET['id'])) {
        $postlist = Post::many(50);
        include_once 'html/post_list.php';
        exit();
    } else {
        $id = $_GET['id'];
        if ($id <= 0 ) {
            Out("找不到文章。");
        }
        $post = Post::get($id);
        $post[POST_TEXT] = FormatArticel($post[POST_TEXT]);
        include_once "html/post_id.php";
        exit();
    }

} catch(PDOException $e) {
    Out(FormatException($e));
}
