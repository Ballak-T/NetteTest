<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 14.7.17
 * Time: 14:39
 */

namespace App\Presenters;

use Doctrine\Common\Annotations\Annotation\Required;
use App\ArticleModule\Service\ArticleService,
    Nette\Application\UI;



class ArticlePresenter extends BasePresenter
{

    /** @var ArticleService @inject */
    public $articleService;

    const DEFAULT_ARTICLE_URL = 'home';

    protected function createComponentAddingForm()
    {
        $form = new UI\Form;
        $form->addText('title', 'Napis:')
            ->setHtmlAttribute('class', 'form-control')
            ->setRequired(true);
        $form->addText('topic', 'Téma')
            ->setHtmlAttribute('class', 'form-control')
            ->setRequired(true);
        $form->addTextArea('content', 'Obsah')
            ->setHtmlAttribute('class', 'form-control')
            ->setRequired(true);
        $form->addSubmit('send','Přidat článek')
            ->setHtmlAttribute('class', 'btn btn-primary');
        $render = $form->getRenderer();
        $render->wrappers['controls']['container'] = NULL;
        $render->wrappers['pair']['container'] = 'div class=form-group';
        $render->wrappers['control']['container'] = 'div class=col-sm-6';
        $render->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
        $render->wrappers['control']['description'] = 'span class=help-block';
        $render->wrappers['control']['h2'] = 'Přidání článku';
        $form->onSuccess[] = [$this, 'addingFormSucceeded'];
        $form->getElementPrototype()->class('ajax');
        return $form;
    }

    public function handleChangeVariable()
    {

        if ($this->isAjax()) {
            echo 'ajax funguje';
        }
        else
        {
            echo 'ajax nefunguje';
        }
    }

    public function addingFormSucceeded(UI\Form $form, $values)
    {
        // ...
        //$dao = $this->EntityManager->getRepository(Article::class);
        //$values['id'] = $this->getUser()->getIdentity()->getId();
        //$this->articleService->createArticle($values);
        //  $this->template->articles = $this->articleService->getArticles($user->getIdentity()->getId());
        //$this->flashMessage('Článek byl úspěšně přidán');
        echo $this->isControlInvalid('articles');
        if ($this->isAjax()) {
            echo "fomulář odeslán AJAXem";
        }
        else
        {
            echo "fomulář nebyl odeslán AJAXem";
        }
        exit();
        //$this->redirect('Article:');
    }

    public function renderDefault($url)
    {
        $httpRequest = $this->getHttpRequest();
        if ($this->isAjax()) {
            echo "fomulář odeslán AJAXem";
        }
        else
        {
            echo "fomulář nebyl odeslán AJAXem";
        }
        if (!$url) $url = self::DEFAULT_ARTICLE_URL;
        $user = $this->getUser();
        if (!$user->isLoggedIn())
        {
            $this->redirect('Homepage:');
        }else{
            $this->template->articles = $this->articleService->getArticles($user->getIdentity()->getId());
            $this->template->username = $user->getIdentity()->getData()['name'];
        }
    }
}
