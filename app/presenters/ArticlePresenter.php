<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 14.7.17
 * Time: 14:39
 */

namespace App\Presenters;

use Nette,
    App\ArticleModule\Service\ArticleService,
    App\UserModule\Service\UserService,
    Nette\Application\UI;



class ArticlePresenter extends Nette\Application\UI\Presenter
{

    /** @var ArticleService @inject */
    public $articleService;

    const DEFAULT_ARTICLE_URL = 'home';

    protected function createComponentAddingForm()
    {
        $form = new UI\Form;
        $form->addText('title', 'Napis:')
            ->setHtmlAttribute('class', 'form-control');
        $form->addText('topic', 'Téma')
            ->setHtmlAttribute('class', 'form-control');
        $form->addTextArea('content', 'Obsah')
            ->setHtmlAttribute('class', 'form-control');
        $form->addSubmit('send','Přidat článek')
            ->setHtmlAttribute('class', 'btn btn-primary');
        $form->onSuccess[] = [$this, 'addingFormSucceeded'];
        $render = $form->getRenderer();
        $render->wrappers['controls']['container'] = NULL;
        $render->wrappers['pair']['container'] = 'div class=form-group';
        $render->wrappers['control']['container'] = 'div class=col-sm-9';
        $render->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
        $render->wrappers['control']['description'] = 'span class=help-block';
        $form->onSuccess[] = [$this, 'loginFormSucceeded'];
        $form->getElementPrototype()->class('form-horizontal');
        return $form;
    }

    public function addingFormSucceeded(UI\Form $form, $values)
    {
        // ...
        //$dao = $this->EntityManager->getRepository(Article::class);
        $values['id'] = $this->getUser()->getIdentity()->getId();
        $this->articleService->createArticle($values);
        $this->flashMessage('Článek byl úspěšně přidán');
        $this->redirect('Article:');
    }
    public function renderDefault($url)
    {
        if (!$url) $url = self::DEFAULT_ARTICLE_URL;
        $user = $this->getUser();
        if (!$user->isLoggedIn())
        {
            $this->redirect('Homepage:');
        }else{
            $this->template->username = $user->getIdentity()->getData()['name'];
        }
    }
}
