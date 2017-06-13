<?php

/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 14:42
 */

require_once dirname(__FILE__)."/../model.class.php";

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

//字段名
const USER_ID = 'id';
const USER_ADDTIME = 'addtime';
const USER_ADDIP = 'addip';
const USER_USERNAME = 'username';
const USER_KEYCODE = 'keycode';
const USER_EMAIL = 'email';

//预定义语句。
const USER_SQL_ADD = "INSERT INTO user (addip, username, keycode, email) values (?, ?, ?, ?)";
const USER_SQL_GET = "select id, addtime, addip, username, keycode, email from user where id = ?";
const USER_SQL_FINDBYNAME = "select id, addtime, addip, username, keycode, email from user where username = ?";

class User extends Model
{

    public static function create_table_if_not_exists() {
        return self::$dbh->exec(user_create_table_sql);
    }

    public static function keycode($name, $password) {
        return md5($name.$password);
    }

    public static function add(array $user) {
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
        $sth = self::$dbh->prepare(USER_SQL_ADD);
        $sth->execute(array($user[USER_ADDIP], $user[USER_USERNAME], $user[USER_KEYCODE], $user[USER_EMAIL]));
        return self::$dbh->lastInsertId();
    }

    public static function get($id) {
        if ($id<=0 ) {
            return null;
        }
        $sth = self::$dbh->prepare(USER_SQL_GET);
        $sth->execute(array($id));
        if ($sth->rowCount() == 0 ) return null;
        $row = $sth->fetch();
        return array(USER_ID=>$row[USER_ID],
            USER_ADDTIME=>$row[USER_ADDTIME],
            USER_ADDIP=>$row[USER_ADDIP],
            USER_USERNAME=>$row[USER_USERNAME],
            USER_KEYCODE=>$row[USER_KEYCODE],
            USER_EMAIL=>$row[USER_EMAIL]);
    }

    public static function find_by_name($name) {
        if (empty($name)) {
            return null;
        }
        $sth = self::$dbh->prepare(USER_SQL_FINDBYNAME);
        $sth->execute(array($name));

        if ($sth->rowCount() == 0 ) return null;
        $row = $sth->fetch();

        return array(USER_ID=>$row[USER_ID],
            USER_ADDTIME=>$row[USER_ADDTIME],
            USER_ADDIP=>$row[USER_ADDIP],
            USER_USERNAME=>$row[USER_USERNAME],
            USER_KEYCODE=>$row[USER_KEYCODE],
            USER_EMAIL=>$row[USER_EMAIL]);
    }
}