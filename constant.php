<?php 
    define("DB_SQL_CREATE_POST", "CREATE TABLE `ding`.`post` 
        ( `id` INT NOT NULL AUTO_INCREMENT , 
        `addtime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        `title` VARCHAR(255)  NOT NULL , 
        `post` MEDIUMTEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM DEFAULT CHARSET=utf8");
?>
