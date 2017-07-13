<?php

/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 13.7.17
 * Time: 13:03
 */

namespace App;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Article
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */

    protected $id;

    /**
     * @ORM\Column(type="integer")
     */

    protected $idUser;

    /**
     * @ORM\Column(type="string")
     */

    protected $title;

    /**
     * @ORM\Column(type="string")
     */

    protected $topic;

    /**
     * @ORM\Column(type="string")
     */

    protected $content;

    /**
     * @ORM\Column(type="string")
     */

    protected $created;

}