<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 15.7.17
 * Time: 14:10
 */

namespace App\Presenters;
use Nette\Application\UI\Form as Form;
use App\UserModule\Service\UserService;
use Nette;

class RegistrationPresenter extends Nette\Application\UI\Presenter
{
    /** @var UserService @inject */
    public $userService;

    protected function createComponentRegistrationForm()
    {
        $form = new Form;
        $form->addText('name', 'Jméno:')
            ->setRequired(true)
            ->addRule(Form::MIN_LENGTH ,'Jméno musí aspoň %d znak', 1)
            ->setHtmlAttribute('class', 'form-control');
        $form->addText('surname', 'Příjmení:')
            ->setRequired(true)
            ->addRule(Form::MIN_LENGTH, 'Příjmení musí mít aspoň %d znak', 1)
            ->setHtmlAttribute('class', 'form-control');
        $form->addText('email', 'Email')
            ->setRequired(true)
            ->addRule(Form::EMAIL, 'Emailová adresa není platná')
            ->setHtmlAttribute('class', 'form-control');
        $form->addPassword('password', 'Heslo')
            ->setRequired(true)
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít minimálně %d znaků',6)
            ->setHtmlAttribute('class', 'form-control');
        $form->addPassword('password_check', 'Heslo znovu')
            ->setRequired(true)
            ->addRule(Form::EQUAL, 'Hesla se neshodují',$form['password'])
            ->setHtmlAttribute('class', 'form-control');
        $form->addTextArea('htmlcontent', 'Html obsah')
            ->setRequired(true)
            ->addRule(Form::MIN_LENGTH, 'Html obsah má mít aspoň %d znaků',10)
            ->setHtmlAttribute('class', 'form-control');
        $form->addSubmit('send','Registrovat')
            ->setHtmlAttribute('class','btn btn-primary');
        $render = $form->getRenderer();
        $render->wrappers['controls']['container'] = NULL;
        $render->wrappers['pair']['container'] = 'div class=form-group';
        $render->wrappers['control']['container'] = 'div class=col-sm-9';
        $render->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
        $render->wrappers['control']['description'] = 'span class=help-block';
        $form->onSuccess[] = [$this, 'registrationFormSucceeded'];
        $form->getElementPrototype()->class('form-horizontal');
        return $form;
    }

    public function registrationFormSucceeded(Nette\Application\UI\Form $form, $values)
    {
        // ...
        //$dao = $this->EntityManager->getRepository(Article::class);
        //print_r($values['name']);
        $this->userService->createUser($values);
        $this->flashMessage('Byl jste úspěšně zaregistrován');
        //$this->redirect('Registration:');
    }

    public function renderDefault($url)
    {
        $user = $this->getUser();
        if (!$user->isLoggedIn())
        {
        }else{
            if (isset($user)) {
                $this->template->username = $user->getIdentity()->getData()['name'];
            }
        }
    }
}