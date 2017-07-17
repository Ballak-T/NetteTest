<?php

/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 17.7.17
 * Time: 11:57
 */
namespace Components;
use Nette\Application\UI\Control;
use App\ArticleModule\Service\ArticleService;
use Nette\Security\User;
use Nette\Application\UI;

class ArticleForm extends Control
{
    /**
     * @var ArticleService @inject
     */
      private $articleService;


    public function __construct(ArticleService $articleService)
    {
        parent::__construct();
        $this->articleService = $articleService;
    }

//    public function render(){
//        $user = $this->presenter->getUser();
//        if ($user->isLoggedIn()) {
//            $id = $user->getIdentity()->getId();
//            $articles = $this->articleService->getArticles($id);
//            $template = $this->template;
//            $template->setFile(__DIR__ . '/AddingArticle.latte');
//            $template->articles = $articles;
//        }
//    }
    public function createForm()
    {
        $form = new UI\Form;
        $form->setAction('/article/');
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
        $form->getElementPrototype()->class('form-horizontal ajax');
        $form = $this->wrapForm($form);
        return $form;
    }
    private function wrapForm(UI\Form $form)
    {
        $render = $form->getRenderer();
        $render->wrappers['controls']['container'] = NULL;
        $render->wrappers['pair']['container'] = 'div class=form-group';
        $render->wrappers['control']['container'] = 'div class=col-sm-6';
        $render->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
        $render->wrappers['control']['description'] = 'span class=help-block';
        $render->wrappers['control']['h2'] = 'Přidání článku';
        $form->setRenderer($render);
        return $form;
    }
}