<?php

namespace Quiz\Controllers;

abstract class BaseController
{
    /** @var array */
    protected $post;

    /** @var array */
    protected $get;

    /** @var string */
    protected $action;

    public function handleCall(string $action)
    {
        $this->action = $action;
        $this->post = $this->prepareParams($_POST);
        $this->get = $this->prepareParams($_GET);

        $this->callAction($action);
    }

    protected function prepareParams(array $params)
    {
        foreach ($params as $key => $value) {
            $params[$key] = htmlspecialchars($value);
        }

        return $params;
    }

    protected function callAction($action)
    {
        echo static::$action();
    }

    protected function render(string $view, array $variables = []): string
    {
        $viewFile = $this->resolveViewFile($view);

        if (file_exists($viewFile)) {
            extract($variables);
            ob_start();
            include "$viewFile";
            $output = ob_get_clean();

            return $output;
        }

        return 'View not found ' . $viewFile;
    }

    protected function resolveViewFile(string $view): string
    {
        return VIEW_DIR . "/$view.phtml";
    }
}