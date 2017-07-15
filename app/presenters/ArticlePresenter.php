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
    App\UserModule\Service\UserService,
    Nette\Application\UI;



class ArticlePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @inject
     * @var \Kdyby\Doctrine\EntityManager
     */

    public $EntityManager;
    const DEFAULT_ARTICLE_URL = 'home';

    protected function createComponentAddingForm()
    {
        $form = new UI\Form;
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
    public function renderDefault($url)
    {
        if (!$url) $url = self::DEFAULT_ARTICLE_URL;
        $user = $this->getUser();
        if ($user->isLoggedIn() === 'ne')
        {
            $this->redirect('Home:');
        }else{

        }
    }
}
