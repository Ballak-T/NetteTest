<?php
/**
 * Created by PhpStorm.
 * User: ballin
 * Date: 15.7.17
 * Time: 13:16
 */

namespace App\ArticleModule\Service;
use Kdyby\Doctrine\EntityManager;
use App\ArticleModule\Entity\Article;

class ArticleService
{

    /**
     * @var EntityManager
     */

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager=$entityManager;
    }
    public function createArticle()
    {
        $article = new Article();
        $article->setTitle('test');
        $article->setContent('content');
        $article->time();
        $article->setTopic('topic');
        $this->entityManager->persist($article);
        $this->entityManager->flush();
    }
}