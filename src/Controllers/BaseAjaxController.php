<?php

namespace Quiz\Controllers;

abstract class BaseAjaxController extends BaseController
{
    public function callAction($action)
    {
        $content = static::$action();

        echo json_encode(['result' => $content], JSON_UNESCAPED_UNICODE);
    }
}