<?php

namespace Jhonattan\MVC\Repository;

use Jhonattan\MVC\Entity\User;

use Jhonattan\MVC\Entity\Video;
use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function addUser(User $user):bool
    {
        $sql = 'INSERT INTO users (nome, email,password) VALUES (?, ?,?)';
        $statement = $this->pdo->prepare($sql);
        $hash = password_hash($user->senha ,PASSWORD_ARGON2ID);
        $statement->bindValue(1, $user->nome);
        $statement->bindValue(2, $user->email);
        $statement->bindValue(3, $hash);
        $result = $statement->execute();
        $id = $this->pdo->lastInsertId();
        $user->setId(intval($id));
        return $result;
    }
    public function removeUser(int $id):bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(":id",$id,PDO::PARAM_INT);
        return $statement->execute();
    }
    public function updateUser(User $user):bool
    {
        $sql = 'UPDATE users SET nome = :nome, email = :email, password = :senha  WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':nome', $user->nome);
        $statement->bindValue(':email', $user->email);
        $statement->bindValue(':senha', $user->senha);
        $statement->bindValue(':id', $user->id, PDO::PARAM_INT);
        return $statement->execute();
    }
    public function allUser():array
    {
        $userList = $this->pdo->query('SELECT * FROM users;')->fetchAll(\PDO::FETCH_ASSOC);

        return  array_map(function(array $userList){
            $user = new User($userList['nome'],$userList['email'],$userList['senha']);
            $user->setId($userList['id']);
            return $user;
        },
            $userList
        );
    }
    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = ?;');
        $statement->bindValue(1,$id,PDO::PARAM_INT);
        $statement->execute();
        return $this->hydrateVideo($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function hydrateVideo(array $userList):User
    {
        $user = new User($userList['nome'],$userList['email'],$userList['senha']);
        $user->setId($userList['id']);
        return $user;
    }
}