<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 13.7.17
 * Time: 20:18
 */

namespace App\UserModule\Entity;
use Doctrine\ORM\Mapping as ORM;
use Nette\Security\Passwords;
use Nette\Utils\DateTime;

/**
 * @ORM\Entity
 */

class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */

    protected $id;

    /**
     * @ORM\Column(type="string")
     */

    protected $name;

    /**
     * @ORM\Column(type="string")
     */

    protected $surname;

    /**
     * @ORM\Column(type="string")
     */

    protected $email;

    /**
     * @ORM\Column(type="string")
     */

    protected $password;

    /**
     * @ORM\Column(type="string")
     */

    protected $htmlText;

    /**
     * @ORM\Column(type="string")
     */

    protected $created;

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = Passwords::hash($password);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getHtmlText()
    {
        return $this->htmlText;
    }
    public function setHtmlText($htmlText)
    {
        $this->htmlText = $htmlText;
    }
    public function setTime()
    {
        $date = new DateTime();
        $this->created = $date->getTimestamp();
    }
}