<?php

namespace Quiz\Controllers;

use Quiz\Repositories\UserRepository;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $repo = new UserRepository();
        $user = $repo->getById(51);

        return $this->render('index', compact('user'));
    }
}