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
            ->setRequired(true);
        $form->addPassword('password', 'Heslo')
            ->setRequired(true);
        $form->addSubmit('send','Přihlásit');
        $form->onSuccess[] = [$this, 'loginFormSucceeded'];
        return $form;
    }
    public function loginFormSucceeded(Nette\Application\UI\Form $form, $values)
    {
        $email = $values['email'];
        $password = $values['password'];

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
            }
        }
        $this->flashMessage($loginMessage);
    }
    public function render()
    {
        //$dao = $this->EntityManager->getRepository(Article::class);
        //dump($dao->findAll());
        //$this->template->articles = $dao->findAll();
        exit();
    }
}