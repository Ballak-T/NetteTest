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
            ->addRule(Form::MIN_LENGTH ,'Jméno musí aspoň %d znak', 1);
        $form->addText('surname', 'Příjmení:')
            ->setRequired(true)
            ->addRule(Form::MIN_LENGTH, 'Příjmení musí mít aspoň %d znak', 1);
        $form->addText('email', 'Email')
            ->setRequired(true)
            ->addRule(Form::EMAIL, 'Emailová adresa není platná');
        $form->addPassword('password', 'Heslo')
            ->setRequired(true)
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít minimálně %d znaků',6);
        $form->addPassword('password_check', 'Heslo znovu')
            ->setRequired(true)
            ->addRule(Form::EQUAL, 'Hesla se neshodují',$form['password']);
        $form->addSubmit('send','Registrovat');
        $form->onSuccess[] = [$this, 'registrationFormSucceeded'];
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

    public function render()
    {
        //$dao = $this->EntityManager->getRepository(Article::class);
        //dump($dao->findAll());
        //$this->template->articles = $dao->findAll();
        exit();
    }
}