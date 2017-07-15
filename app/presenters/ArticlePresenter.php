<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 14.7.17
 * Time: 14:39
 */

namespace App\Presenters;

use Nette,
    App\ArticleModule\Entity\Article,
    Nette\Application\UI;



class ArticlePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @inject
     * @var \Kdyby\Doctrine\EntityManager
     */

    public $EntityManager;

    protected function createComponentAddingForm()
    {
        $form = new UI\Form;
        $form->addText('name', 'Autor:');
        $form->addText('title', 'Napis:');
        $form->addText('topic', 'Téma');
        $form->addTextArea('content', 'Obsah');
        $form->addSubmit('send','Přidat článek');
        $form->onSuccess[] = [$this, 'addingFormSucceeded'];
        return $form;
    }

    public function addingFormSucceeded(UI\Form $form, $values)
    {
        // ...
        //$dao = $this->EntityManager->getRepository(Article::class);
        $this->flashMessage('Článek byl úspěšně přidán');
        $this->redirect('Article:');
    }

    public function render()
    {
        $dao = $this->EntityManager->getRepository(Article::class);
        //dump($dao->findAll());
        $this->template->articles = $dao->findAll();
        exit();
    }
}
