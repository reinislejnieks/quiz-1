<?php

namespace Quiz\Controllers;

use Illuminate\Support\Collection;

abstract class BaseController
{
    /** @var string */
    protected $template = 'default';

    /** @var Collection */
    protected $post;

    /** @var Collection */
    protected $get;

    /** @var string */
    protected $action;

    /**
     * @param string $action
     */
    public function handleCall(string $action)
    {
        $this->action = $action;
        $this->post = $this->prepareParams($_POST);
        $this->get = $this->prepareParams($_GET);

        $this->callAction($action);
    }

    /**
     * @param array $params
     * @return Collection
     */
    protected function prepareParams(array $params): Collection
    {
        foreach ($params as $key => $value) {
            $params[$key] = htmlspecialchars($value);
        }

        return collect($params);
    }

    /**
     * @param $action
     */
    protected function callAction($action)
    {
        echo static::$action();
    }

    /**
     * @param string $view
     * @param array $variables
     * @return string
     */
    protected function render(string $view, array $variables = []): string
    {
        $viewFile = $this->resolveViewFile($view);
        $templateFile = $this->resolveTemplateFile($this->template);

        if (!file_exists($viewFile)) {
            return 'View not found ' . $viewFile;
        }

        $content = $this->getViewContent($viewFile, $variables);

        if (!file_exists($templateFile)) {
            return $content;
        }

        return $this->getViewContent($templateFile, compact('content'));
    }

    /**
     * @param string $fileName
     * @param array $variables
     * @return string
     */
    public function getViewContent(string $fileName, array $variables = []): string
    {
        extract($variables);
        ob_start();
        include "$fileName";

        return ob_get_clean();
    }

    /**
     * @param string $template
     * @return string
     */
    protected function resolveTemplateFile(string $template): string
    {
        return TEMPLATE_DIR . "/$template.phtml";
    }

    /**
     * @param string $view
     * @return string
     */
    protected function resolveViewFile(string $view): string
    {
        return VIEW_DIR . "/$view.phtml";
    }
}