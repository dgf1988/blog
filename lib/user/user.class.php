<?php

/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 14:42
 */


require_once dirname(__FILE__) . "/../tool.php";

const user_create_table_sql = <<<eof
    CREATE TABLE IF NOT EXISTS user ( 
        id INT NOT NULL AUTO_INCREMENT KEY , 
        addtime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        addip BIGINT NOT NULL , 
        username VARCHAR(20) NOT NULL UNIQUE , 
        keycode CHAR(32) NOT NULL , 
        email VARCHAR(100) NOT NULL , 
        power INT NULL DEFAULT NULL , 
        note VARCHAR(1000) NULL DEFAULT NULL
    ) ENGINE = innodb DEFAULT CHARSET = UTF8;
eof;

const USER_ID = 'id';
const USER_ADDTIME = 'addtime';
const USER_ADDIP = 'addip';
const USER_USERNAME = 'username';
const USER_KEYCODE = 'keycode';
const USER_EMAIL = 'email';


class User
{
    public static function CreateTableIfNotExists(PDO $pdo) {
        return $pdo->exec(user_create_table_sql);
    }

    public static function Add(PDO $pdo, array $user) {
        if (!is_array($user)) {
            return 0;
        }
        if (empty($user[USER_ADDIP])) {
            return 0;
        }
        if (empty($user[USER_USERNAME])) {
            return 0;
        }
        if (empty($user[USER_KEYCODE])) {
            return 0;
        }
        if (empty($user[USER_EMAIL])) {
            return 0;
        }
        //$sql = "INSERT INTO user (addip, username, keycode, email) values ($ip, '$username', '$keycode', '$email')";
        $sql = "INSERT INTO user (addip, username, keycode, email) values (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user[USER_ADDIP], $user[USER_USERNAME], $user[USER_KEYCODE], $user[USER_EMAIL]));
        return $pdo->lastInsertId();
    }

    public static function Get(PDO $pdo, $id) {
        if ($id<=0 ) {
            return null;
        }
        $sql = "select id, addtime, addip, username, keycode, email from user where id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch();
        return array(USER_ID=>$row[USER_ID],
            USER_ADDTIME=>$row[USER_ADDTIME],
            USER_ADDIP=>ntoip($row[USER_ADDIP]),
            USER_USERNAME=>$row[USER_USERNAME],
            USER_KEYCODE=>$row[USER_KEYCODE],
            USER_EMAIL=>$row[USER_EMAIL]);
    }
}