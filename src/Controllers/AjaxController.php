<?php

namespace Quiz\Controllers;

use Quiz\Models\User;
use Quiz\Repositories\UserRepository;

class AjaxController extends BaseAjaxController
{
    public function indexAction()
    {
        $repo = new UserRepository();
        $user = new User();
        $user->name = 'Kārlis';
        $repo->save($user);

        return $user;
    }

    public function saveUserAction()
    {
        $name = $this->post['name'];
        $repo = new UserRepository();
        $user = new User();
        $user->name = $name;
        $repo->save($user);

        return $user;
    }
}