<?php

namespace Quiz\Controllers;

use Quiz\Repositories\UserRepository;

class IndexController extends BaseController
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexAction()
    {
        $user = $this->userRepository->one();

        return $this->render('index', compact('user'));
    }
}