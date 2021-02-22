<?php
namespace testtask\Controllers;

use testtask\Controllers\AbstractController;
use testtask\View\View;
use testtask\Services\Db;
use testtask\Models\Casino;
//use Services\UsersAuthService;

class MainController extends AbstractController
{
    private $db;

    public function __construct()
    {
        parent::__construct();

        $this->db = Db::getinstance();
    }

    public function main()
    {
//        $casinos = $this->db->query("SELECT * FROM `casinos`", [], Casino::class);
        $casinos = Casino::getAll();
        $this->view->renderHtml('main/main.php', ['casinos' => $casinos]);
    }

    public function sayHello($name)
    {
            $this->view->renderHtml("main/hello.php", ['name' => $name]);
    }
}