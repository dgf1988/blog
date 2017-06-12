<?php
/**
 * Created by PhpStorm.
 * User: 国锋
 * Date: 2017/6/12
 * Time: 22:22
 */

    const user_create_table_sql = <<<s
        CREATE TABLE `ding`.`user` ( 
            `id` INT NOT NULL , 
            `addtime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            `addip` BIGINT NOT NULL , 
            `name` VARCHAR(20) NOT NULL , 
            `key` CHAR(32) NOT NULL , 
            `email` VARCHAR(100) NOT NULL , 
            `group` INT NULL DEFAULT NULL , 
            `note` VARCHAR(1000) NULL DEFAULT NULL , 
            PRIMARY KEY (`id`), 
            UNIQUE (`name`)
        ) ENGINE = MyISAM DEFAULT CHARSET = UTF8;
s;

    function user_create_table (PDO $db) {
        return $db->exec(user_create_table_sql);
    }