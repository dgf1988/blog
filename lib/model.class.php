<?php

/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 21:53
 */

require_once 'sql.php';

class Model
{
    public static $dbh = null;
    public static $lastErrorCode = 0;
    public static $lastErrorMessage = '';

    function __construct(PDO $pdo)
    {
        if (empty($pdo)) {
            throw new DatabasesException("数据库没有连接成功。");
        }
        self::$dbh = $pdo;
    }

    protected static function hasError(PDOStatement $sth) {
        self::$lastErrorCode = $sth->errorInfo()[1];
        self::$lastErrorMessage = $sth->errorInfo()[2];
        return !empty(self::$lastErrorCode);
    }
}

class DatabasesException extends PDOException {
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}