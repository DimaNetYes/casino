<?php


namespace testtask\Controllers;

//use Services\UsersAuthService;
use testtask\View\View;

abstract class AbstractController
{
    /** @var View */
    protected $view;

    /** @var User|null */
    protected $user;

    public function __construct()
    {
//        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View('../templates');
//        $this->view->setVar('user', $this->user);
    }
}