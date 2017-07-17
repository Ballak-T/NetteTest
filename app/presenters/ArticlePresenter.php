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
use Components\ArticleForm;



class ArticlePresenter extends BasePresenter
{

    /** @var ArticleService @inject */
    public $articleService;

    /** @var ArticleForm @inject */
    public $articleComponent;

    const DEFAULT_ARTICLE_URL = 'home';

    protected function createComponentAddingForm()
    {
        $form = $this->articleComponent->createForm();
        $form->onSuccess[] = [$this, 'handleAdd'];
        return $form;
    }
    public function handleAddArticle(UI\Form $form, $values)
    {
        echo "Test";
        print_r($values);
    }
    public function renderDefault($url)
    {
        $user = $this->getUser();
        if (!$user->isLoggedIn())
        {
            $this->redirect('Homepage:');
        }else{

            $this->template->articles = $this->articleService->getArticles($user->getIdentity()->getId());
            $this->template->username = $user->getIdentity()->getData()['name'];

        }
    }
    public function handleAdd()
    {
        if ($this->isAjax()) {
            $this->template->variable = 'Ajax works!';
            $this->redrawControl('articles');
        }else
        {
            $this->flashMessage('Ajax nefunguje','danger');
        }
    }
}
