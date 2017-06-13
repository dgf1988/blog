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


$id = 0;
if (isset($_GET["id"])) {
    $id = $_GET['id'];
} else {
    die("请输入参数");
}
