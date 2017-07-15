<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 15.7.17
 * Time: 14:48
 */

namespace App\UserModule\Service;

use App\UserModule\Entity\User;
use Doctrine\ORM\EntityManager;

class UserService
{

    /**
     * @var EntityManager
     */

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function createUser($inputs){
        $user = new User();
        $user->setName($inputs['name']);
        $user->setSurname($inputs['surname']);
        $user->setEmail($inputs['email']);
        $user->setHtmlText($inputs['htmltext']);
        $user->setPassword($inputs['password']);
        $user->setTime();

        $this->entityManager->persist($user);
        $this->entityManager->flush($user);
    }
}