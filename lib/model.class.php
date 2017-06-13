<?php

/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 21:53
 */
class Model
{
    public static $dbh = null;

    function __construct(PDO $pdo)
    {
        if (empty($pdo)) {
            throw new PDOException("数据库没有连接成功。");
        }
        self::$dbh = $pdo;
    }
}