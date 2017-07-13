<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 13.7.17
 * Time: 15:25
 */

namespace App;
use Doctrine\ORM\Mapping as ORM;


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

    protected $htmlText;

    /**
     * @ORM\Column(type="string")
     */

    protected $created;
}