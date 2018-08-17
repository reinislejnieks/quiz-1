<?php

namespace Quiz\Controllers;

use Quiz\Models\User;
use Quiz\Repositories\UserRepository;

class AjaxController extends BaseAjaxController
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function saveUserAction()
    {
        $name = $this->post->get('name');
        /** @var User $user */
        $user = $this->userRepository->create();
        $user->name = $name;
        $this->userRepository->save($user);

        return $user;
    }
}