<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 16.7.17
 * Time: 18:49
 */

namespace App\Presenters;

use Nette;
class BasePresenter extends Nette\Application\UI\Presenter
{
    public function renderDefault($url)
    {
        $user = $this->getUser();
        if (!$user->isLoggedIn())
        {
            $this->redirect('Homepage:');
        }else{

            $this->template->articles = $this->articleService->getArticles($user->getIdentity()->getId());
            $this->template->username = $user->getIdentity()->getData()['name'];
            $this->template->variable = 'change+';
            if ($this->isAjax()) {
                $this->template->variable = 'Ajax works!';
                $this->redrawControl('articles');
            }

        }
    }
}