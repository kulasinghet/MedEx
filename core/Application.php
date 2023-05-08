<?php

namespace app\core;

class Application
{

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public static Application $app;


    public function __construct()
    {
        self::$ROOT_DIR = dirname(__DIR__);
        self::$app = $this;
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->response = new Response();
        $this->controller = new Controller();
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }

}
