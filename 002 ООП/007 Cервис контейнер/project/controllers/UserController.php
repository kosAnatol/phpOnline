<?php
namespace App\controllers;

use App\engine\Container;
use App\entities\UserEntity;
use App\repositories\UserRepository;

class UserController
{
    protected $defaultAction = 'index';

    public function __construct(
        protected Container $container
    )
    {
    }

    public function run(string $action)
    {
        if (empty($action)) {
            $action = $this->defaultAction;
        }

        $action .= 'Action';
        if (!method_exists($this, $action)) {
            echo '404';
            return;
        }

        $this->$action();
    }

    public function indexAction()
    {
        echo 'indexAction';
    }

    public function oneAction()
    {
//        $user = $this->container->userRepository->getOne($this->container->request->getId() ?? 1);
//        $user = $this->container->db->userRepository->getOne($_GET['id'] ?? 1);
        $user = $this->container->userRepository->getOne($_GET['id'] ?? 1);
        echo $this->container->renderService->getRender(
            'user',
            [
                'user' => $user,
                'title' => 'Информация о пользователе'
            ]
        );
    }

    public function allAction()
    {
        echo $this->container->renderService->getRender(
            'users',
            [
                'title' => 'Список пользователей',
                'users' => $this->container->userRepository->getAll(),
            ]
        );
    }

    public function saveAction()
    {
        $user = new UserEntity();
        $user->title = $_GET['title'] ?? '';
        $user->author = $_GET['author'] ?? '';
        $user->content = $_GET['content'] ?? '';

        (new UserRepository())->save($user);
    }
}