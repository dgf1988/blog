<?php

/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/13
 * Time: 21:51
 */
require_once dirname(__FILE__)."/../model.class.php";

const post_create_table_sql = <<<eof
    CREATE TABLE IF NOT EXISTS post ( 
        `id` INT NOT NULL AUTO_INCREMENT KEY , 
        `post_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        `post_ip` BIGINT NOT NULL , 
        `post_user` VARCHAR(20) NOT NULL , 
        `post_title` VARCHAR(200) NOT NULL , 
        `post_text` MEDIUMTEXT NOT NULL , 
        `post_cat` INT NOT NULL DEFAULT '1' 
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
eof;

const POST_ID = 'id';
const POST_TIME = 'post_time';
const POST_IP = 'post_ip';
const POST_USER = 'post_user';
const POST_TITLE = 'post_title';
const POST_TEXT = 'post_text';
const POST_CAT = 'post_cat';

const POST_SQL_ADD = 'insert into post (post_ip, post_user, post_title, post_text) values (?,?,?,?)';
const POST_SQL_DEL = 'delete from post where id = ?';
const POST_SQL_SET = "update post set \'%s\' = ? where id = ?";
const POST_SQL_GET = 'select id, post_time, post_ip, post_user, post_title, post_text, post_cat from post where id = ?';
const POST_SQL_LIST =
'select id, post_time, post_ip, post_user, post_title, post_text, post_cat from post order by id desc limit  ?, ?';

class Post extends Model
{
    public static function create_table_if_not_exists() {
        return self::$dbh->exec(post_create_table_sql);
    }

    public static function add(array $post) {
        if (!is_array($post) or
            empty($post[POST_IP]) or
            empty($post[POST_USER]) or
            empty($post[POST_TITLE]) or
            empty($post[POST_TEXT])) {
            return 0;
        }
        $sth = self::$dbh->prepare(POST_SQL_ADD);
        $sth->execute(array($post[POST_IP], $post[POST_USER], $post[POST_TITLE], $post[POST_TEXT]));
        return self::$dbh->lastInsertId();
    }

    public static function del($id) {
        if (!is_integer($id) or $id <= 0) {
            return 0;
        }
        $sth = self::$dbh->prepare(POST_SQL_DEL) ;
        $sth->execute(array($id));
        return $sth->rowCount();
    }

    public static function set($id, $key, $value) {
        if (!is_integer($id) or $id <= 0 or empty($key) or empty($value)) {
            return 0;
        }
        $sql = sprintf(POST_SQL_SET, $key);
        $sth = self::$dbh->prepare($sql) ;
        $sth->execute(array($value, $id));
        return $sth->rowCount();
    }

    public static function get($id) {
        if (!is_integer($id) or $id <= 0) {
            return null;
        }
        $sth = self::$dbh->prepare(POST_SQL_GET) ;
        $sth->execute(array($id));
        $row = $sth->fetch();
        return array(
            POST_ID=>$row[POST_ID],
            POST_TIME=>$row[POST_TIME],
            POST_IP=>$row[POST_IP],
            POST_USER=>$row[POST_USER],
            POST_TITLE=>$row[POST_TITLE],
            POST_TEXT=>$row[POST_TEXT],
            POST_CAT=>$row[POST_CAT]
        );
    }

    public static function list($lenght=10, $begnum=0) {
        $sth = self::$dbh->prepare(POST_SQL_LIST);
        $sth->bindValue(1, $begnum, PDO::PARAM_INT);
        $sth->bindValue(2, $lenght, PDO::PARAM_INT);
        $sth->execute();
        if ($sth->errorCode() != '00000') {
            throw new PDOException($sth->errorInfo()[2], $sth->errorInfo()[1]);
        }
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}