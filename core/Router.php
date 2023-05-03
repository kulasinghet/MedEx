<?php

namespace app\core;

class Router
{
    public Request $request;
    protected array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        Logger::logPath($path);
        if ($callback === false) {

            Application::$app->response->setStatusCode(404);
            return header('Location: /404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback); //todo: add params as a second argument
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback, $this->request);

    }

//    public function renderView($view, $params = []): void
//    {
//        //todo: can add layout as a variable https://youtu.be/GTESlsYTUns?t=2274
//        include_once "../views/$view";
//    }

    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        echo $viewContent;
    }

    private function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once "../views/$view";
        return ob_get_clean();
    }
}
