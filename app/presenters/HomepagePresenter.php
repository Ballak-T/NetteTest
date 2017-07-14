<?php

namespace App\Presenters;

use Nette,
    App\Model as Model;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @inject
     * @var \Kdyby\Doctrine\EntityManager
     */

    public $EntityManager;

    public function renderDfault()
    {
        $dao = $this->EntityManager->getRepository(Model::getClassNme());
        //dump($dao->findAll());
        $this->template->articles = $dao->findAll();
        exit();
    }
}
