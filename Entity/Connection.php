<?php

namespace Entity;

abstract class Connection
{

    private static $pdo;

    private static function setConnection(): void
    {
        self::$pdo = new \PDO("mysql:host=localhost;dbname=monblog;charset=utf8", "root", "");
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
    }


    protected function getConnection(): mixed
    {
        if(self::$pdo === null){
            self::setConnection();
        } //end if().

        return self::$pdo;
    }

}
