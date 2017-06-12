<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/12
 * Time: 22:03
 */

require_once dirname(__FILE__)."/../config.php";

const mysql_connect_string = 'mysql:host=hostlocal;dbname=ding;charset=utf8';


function mysql_make_connect_string ($host, $dbname, $charset) {
    return "mysql:host=".$host.";dbname=".$dbname.";charset=".$charset;
}

function mysql_open() {
    return new PDO(mysql_make_connect_string(DB_HOST, DB_NAME, DB_CHARSET), DB_USER, DB_PSWD);
}