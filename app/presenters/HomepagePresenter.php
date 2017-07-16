<?php

namespace App\Presenters;

use App\ArticleModule\Service\ArticleService,
    App\UserModule\Service\UserService;
use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{

    public function renderDefault($url)
    {
        $user = $this->getUser();
        if (!$user->isLoggedIn())
        {

        }else{
            $this->template->username = $user->getIdentity()->getData()['name'];
        }
    }
}
