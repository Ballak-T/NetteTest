<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 14.7.17
 * Time: 14:39
 */

namespace App\Presenters;

use Nette,
    App\Model\Article as Article;


class ArticlePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @inject
     * @var \Kdyby\Doctrine\EntityManager
     */

    public $EntityManager;

    public function renderDfault()
    {
        $dao = $this->EntityManager->getRepository(Article::class);
        //dump($dao->findAll());
        $this->template->articles = $dao->findAll();
        exit();
    }
}
