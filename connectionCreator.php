<?php


class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        try {

            $user = 'root';
            $password = "";
            $dbPath = "mysql:host=localhost;dbname=aluraFlix";
            $connection = new PDO($dbPath,$user,$password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $connection;
        }catch (PDOException $e){
            echo ("Erro na conexao". $e->getMessage());
        }

    }
}




