<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 15.7.17
 * Time: 22:01
 */

namespace App\UserModule\Login;
use Doctrine\ORM\EntityManager;
use Nette\Security as Security;
use App\UserModule\Service\UserService;


class LoginAuthenticator implements Security\IAuthenticator
{
    /** @var UserService @inject */
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function authenticate(array $credentials)
    {
        list($email,$password) = $credentials;

        $user = $this->userService->findUser($email);

        if (!$user)
        {
            throw new Security\AuthenticationException('Uživatel neexistuje');
        }
        if (!Security\Passwords::verify($password,$user->getPassword()))
        {
            throw new Security\AuthenticationException('Zadali jste špatné heslo');
        }
        return new Security\Identity($user->getId(), 'Admin', ['name' => $user->getSurname()]);
    }
}