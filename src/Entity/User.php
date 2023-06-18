<?php

namespace Jhonattan\MVC\Entity;

class User
{
    public  string $nome;
    public  string $email;
    public  string $senha;
    public readonly int $id;

    /**
     * @param string $nome
     * @param string $email
     * @param string $senha
     */
    public function __construct(string $nome, string $email, string $senha)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);

    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
            $this->nome = $nome;

    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    /**
     * @param string $senha
     */
    public function setSenha(string $senha): void
    {
            $this->senha = $senha;
    }
    public function setId(int $id):void
    {
        $this->id=$id;

    }


}
