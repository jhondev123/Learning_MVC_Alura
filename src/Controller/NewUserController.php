<?php

namespace Jhonattan\MVC\Controller;

use ConnectionCreator;
use Jhonattan\MVC\Entity\User;
use Jhonattan\MVC\Repository\UserRepository;

class NewUserController implements Controller
{
    public function __construct()
    {
    }

    public function processaRequisicao(): void
    {
        $pdo = ConnectionCreator::createConnection();
        $userRepository = new UserRepository($pdo);

        $nome = filter_input(INPUT_POST, 'nome');

        if ($nome === false) {
            header('Location: /registro?sucesso=0nome');
            return;

        }
        $email = filter_input(INPUT_POST, 'email');
        if ($email === false) {
            header('Location: /registro?sucesso=0email');
            return;
        }
        $senha = filter_input(INPUT_POST, 'senha');
        if ($senha === false) {
            header('Location: /registro?sucesso=0senha');
            return;
        }

        $sucess = $userRepository->addUser(new User($nome,$email,$senha));
        if($sucess === false){
            header('Location: /registro?sucesso=0');
        }else{
            header('Location: /login?sucesso=1');
        }
    }
}