<?php

namespace App\Config;

use PDO;
use PDOException;


class Database
{

    private static string $host =
        'localhost';

    private static string $dbname =
        'aula6';

    private static string $username =
        'root';

    private static string $password =
        '';


    public static function getConnection(): PDO
    {

        try {

            $dsn =
                "mysql:host="
                . self::$host
                . ";dbname="
                . self::$dbname
                . ";charset=utf8mb4";


            $pdo =
                new PDO(
                    $dsn,
                    self::$username,
                    self::$password
                );


            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );


            return $pdo;

        } catch (
            PDOException $e
        ) {

            die(
                "Erro na conexão: "
                . $e->getMessage()
            );

        }

    }

}