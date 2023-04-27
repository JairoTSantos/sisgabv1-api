<?php

class Conexao extends PDO {

    public static $instance;

    public static function getInstance() {

       $configs = include '../config/db_config.php';

        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host='.$configs->host.';dbname='.$configs->database, $configs->username, $configs->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }

}
