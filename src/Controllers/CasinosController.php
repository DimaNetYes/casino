<?php


namespace Controllers;

use Exceptions\UnauthorizedException;
use testtask\View\View;
use testask\Services\Db;
use testask\Models\Article;
//use Model\User;
//use Services\UsersAuthService;
use testtask\Controllers\AbstractController;

class ArticlesController extends AbstractController
{
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Db::getinstance();
    }

    public function add()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('article/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /article/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
        return;

    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('article/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /article/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function del(int $articleId)
    {
        $article = Article::getById($articleId);
        $article->delete();
    }

    public function view($id)
    {
        $article = Article::getById($id);
        $articleAuthor = User::getById($article->getAuthorId());

        $reflector = new \ReflectionObject($article);
        $properties = $reflector->getProperties();

        $propertiesNames = [];
        foreach ($properties as $property) {
            $propertiesNames[] = $property->getName();
        }
//        var_dump($propertiesNames);
        if ($article === null) {
            throw new NotFoundException();
        }
        $this->view->renderHtml("main/articles.php", ["article" => $article, "articleAuthor" => $articleAuthor]);
    }

}
