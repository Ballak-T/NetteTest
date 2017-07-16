<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 15.7.17
 * Time: 20:40
 */

namespace App\Presenters;
use Nette;
use App\UserModule\Service\UserService;
use Nette\Security\AuthenticationException;
use Nette\Application\UI\Form as Form;

class LoginPresenter extends Nette\Application\UI\Presenter
{
    /** @var UserService @inject */
    public $userService;

    protected function createComponentLoginForm()
    {
        $form = new Form;
        $form->addText('email', 'Email')
            ->setRequired(true)
            ->setHtmlAttribute('class', 'form-control');
        $form->addPassword('password', 'Heslo')
            ->setRequired(true)
            ->setHtmlAttribute('class', 'form-control');
        $form->addSubmit('send','Přihlásit')
            ->setHtmlAttribute('class','btn btn-primary');
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
    public function loginFormSucceeded(Nette\Application\UI\Form $form, $values)
    {
        $email = $values['email'];
        $password = $values['password'];
        $type = 'success';
        $user = $this->getUser();
        if ($user->isLoggedIn() === 'ano')
        {
            $loginMessage = 'Už jste přihlášen';
        }else
        {
            $loginMessage = 'Byl jste úspěšně přihlášen';
            try {
                $user->login($email, $password);
                $user->setExpiration('2 days');
            }catch (Nette\Security\AuthenticationException $e) {
                $loginMessage = $e->getMessage();
                $type='danger';
            }
        }
        $this->flashMessage($loginMessage,$type);
    }
    public function renderDefault($url)
    {
        $user = $this->getUser();
        if (!$user->isLoggedIn())
        {
            //$this->redirect('Home:');
        }else{
            $this->template->username = $user->getIdentity()->getData()['name'];
        }
    }
    public function render()
    {

        //$dao = $this->EntityManager->getRepository(Article::class);
        //dump($dao->findAll());
        //$this->template->articles = $dao->findAll();
        exit();
    }
}