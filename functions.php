<?php 
    require_once("mysql.php");
    require_once("constant.php");
    function test_db() {
        $mydb = mydb_connect(DB_HOST, DB_NAME, DB_CHARSET, DB_USER, DB_PSWD);
        //$db_c->exec("SET NAMES 'utf8';");
        //$db_str = $db_c->query(DB_SQL_CREATE_POST);
        $res = $mydb->query("select count(*) as num from post");
        $num = $res->fetchColumn();
        return $num;
        //return 0;
    }
?>
