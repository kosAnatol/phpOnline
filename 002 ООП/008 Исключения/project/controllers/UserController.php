<?php
namespace App\controllers;

use App\engine\Container;
use App\entities\UserEntity;
use App\exceptions\User777Exception;
use App\repositories\UserRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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

        try {
            $id = $this->getId();
            $user = $this->container->userRepository->getOne($id);
        } catch (User777Exception $exception) {
            $exception->log();
            return;
        } catch (\Exception $exception) {
            echo $exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine();
            return;
        } finally {
            echo 'logs';
        }


        echo $this->container->renderService->getRender(
            'user',
            [
                'user' => $user,
                'title' => 'Информация о пользователе'
            ]
        );
    }

    /**
     * @return int
     * @throws \Exception
     */
    protected function getId(): int
    {
        if (empty($_GET['id'])) {
            $this->noFoundId();
        }

        return (int)$_GET['id'];
    }

    /**
     * @throws \Exception
     */
    protected function noFoundId(): void
    {
        throw new \Exception('Не передан id');
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

    public function getCurrenciesAction()
    {
//        echo file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');

        $client = new Client();
        $request = new Request('GET', 'https://www.cbr-xml-daily.ru/daily_json.js');
        $responce = $client->send($request);
    }
}