<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 07/02/2018
 * Time: 11:20
 */

namespace Lib;

use PDO;

class PDOFactory
{
    const BDD = "catalogue";
    const HOST = "localhost";
    const USER = "root";
    const PWD = "";

    protected static $bdd = null;

    /**
     * @return PDO
     */
    public static function get()
    {
        if (self::$bdd === null) {
            self::$bdd = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::BDD . ';charset=utf8', self::USER, self::PWD,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        return self::$bdd;
    }
}