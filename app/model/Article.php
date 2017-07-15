<?php

/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 13.7.17
 * Time: 13:03
 */

namespace App\ArticleModule\Entity;
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
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */

    protected $user;

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

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function time(){
        $this->created = time();
    }
}