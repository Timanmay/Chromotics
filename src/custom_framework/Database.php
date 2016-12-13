<?php

class Database {

    public static function getDb()
    {
        return new PDO("mysql:host=localhost;charset=utf8", "root", "root");
    }





}