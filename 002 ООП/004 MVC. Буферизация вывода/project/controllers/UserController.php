<?php
namespace App\controllers;

use App\models\User;

class UserController
{
    protected $defaultAction = 'index';

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
        $user = User::getOne($_GET['id'] ?? 1);
        echo  $this->render('user', 'Информация о пользователе', ['user' => $user]);
    }

    public function allAction()
    {
        echo  $this->render('users', 'Список пользователей',  ['users' => User::getAll()]);
    }

    protected function render(string $view, string $title, array $params = []): string
    {
        $content = $this->renderView($view, $params);
        return $this->renderView(
            'layout/main',
            [
                'title' => $title,
                'content' => $content
            ]
        );
    }

    protected function renderView(string $view, array $params = []): string
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $view . '.php';
        return ob_get_clean();
    }
}