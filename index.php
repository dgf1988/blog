<?php 
    //define("DB_STR", "mysql:host=localhost;dbname=ding;charset=utf8");
    define("DB_HOST", "localhost");
    define("DB_NAME", "ding");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "ding");
    define("DB_PSWD", "guofeng");
    require_once("mysql.php");
    $dbchar = new MydbType(MydbType::CHAR, 100);
    $dbint = new MydbType(MydbType::NUM);
    $dbdata = new MydbType(MydbType::DATA, 100);
    $dbtimestamp = new MydbType(MydbType::TIMESTAMP, 100);
    $culomnid = new MydbColumn(1, "id", new MydbType(MydbType::NUM));
    $culomnid->isAutoIncrement = true;

    $testtime = new MydbColumn(1, "testtime", new MydbType(MydbType::DATETIME));
    $testtime->hasDefault = false;
    $testtime->isOnUpdate = true;
    $table = new MydbTable("test");
    array_push($table->columns, $culomnid, $testtime);
    $mydb = mydb_connect(DB_HOST, DB_NAME, DB_CHARSET, DB_USER, DB_PSWD);
    //$db_c->exec("SET NAMES 'utf8';");
    //$db_str = $db_c->query(DB_SQL_CREATE_POST);
    $res = $mydb->exec($table->to_sql());
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>这是一个测试页</title>
</head>
<body>
    <center><?php echo $dbchar->to_sql() ?></center>
    <center><?php echo $dbint->to_sql() ?></center>
    <center><?php echo $dbdata->to_sql() ?></center>
    <center><?php echo $dbtimestamp->to_sql() ?></center>
    <center><?php echo $culomnid->to_sql() ?></center>
    <center><?php echo $testtime->to_sql() ?></center>
    <center><?php echo $res ?></center>
    <center><?php echo $table->to_sql()  ?></center>
    <center><?php echo var_dump($mydb->errorInfo())   ?></center>
</video>

</body>
</html>
