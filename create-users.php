<?php
require_once "connectionCreator.php";
$pdo = ConnectionCreator::createConnection();
$email = $argv[1];
$senha = $argv[2];
$hash = password_hash($senha,PASSWORD_ARGON2ID);
$sql = " INSERT INTO users (email, password)VALUES (?,?);";
$statement = $pdo->prepare($sql);
$statement->bindValue(1,$email);
$statement->bindValue(2,$hash);
$statement->execute();



