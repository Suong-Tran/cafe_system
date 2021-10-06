<?php
namespace Humber\Model;

class Database
{
    //properties
    private static $user = 'suongtra_php-knight';
    private static $pass = 'yangyoseob102';
    private static $dsn = 'mysql:host=localhost;dbname=suongtra_inventory';
    private static $dbcon;

    private function __construct()
    {
    }

    //get pdo connection
    public static function getDb(){
        if(!isset(self::$dbcon)) {
            try {
                self::$dbcon = new \PDO(self::$dsn, self::$user, self::$pass);
                self::$dbcon->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$dbcon->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            } catch (\PDOException $e) {
                $msg = $e->getMessage();
                include './custom-error.php';
                exit();
            }
        }

        return self::$dbcon;
    }
}