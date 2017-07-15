<?php

namespace App\Presenters;

use App\ArticleModule\Service\ArticleService;
use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{

    /**
     * @var ArticleService @inject
     */
    public $articleService;

    public function renderDefault()
    {
        echo 'tes';
        $this->articleService->createArticle();
        //$dao = $this->EntityManager->getRepository(User::class);
        //dump($dao->findAll());
        //$this->template->articles = $dao->findAll();
        exit();
    }
}
