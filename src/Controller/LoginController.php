<?php

namespace Jhonattan\MVC\Controller;

use PDO;

class LoginController implements Controller
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = \ConnectionCreator::createConnection();
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $sql = 'SELECT * FROM users WHERE email = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->execute();

        $userData = $statement->fetch(PDO::FETCH_ASSOC);


        $correctPassword = password_verify($password, $userData['password'] ?? "");

        if(password_needs_rehash($userData['password'],PASSWORD_ARGON2ID)){
            $statement= $this->pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $statement->bindValue(1,password_hash($password,PASSWORD_ARGON2ID));
            $statement->bindValue(2,$userData['id']);
            $statement->execute();
        }



        if ($correctPassword) {
            $_SESSION['logado'] = true;
            header('Location: /');

        } else {
            header('Location: /login?sucesso=0');
        }
    }
}