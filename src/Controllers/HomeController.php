<?php

namespace Quiz\Controllers;

class HomeController extends BaseController
{
    public function indexAction()
    {
        return $this->render('home');
    }
}