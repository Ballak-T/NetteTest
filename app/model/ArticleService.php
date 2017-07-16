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
use  Nette\Security\User;

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
    public function createArticle($inputs)
    {
        $article = new Article();
        $article->setUser($inputs['id']);
        $article->setTitle($inputs['title']);
        $article->setContent($inputs['content']);
        $article->setTime();
        $article->setTopic($inputs['topic']);
        $this->entityManager->persist($article);
        $this->entityManager->flush();
    }
    public function getArticles($id)
    {
        $articles = $this->entityManager->getRepository(Article::class)->findBy(array('user'=>$id));
//        $return['title'] = $articles->getTitle();
//        $return['topic'] = $articles->getTopic();
//        $return['content'] = $articles->getContent();
        return $articles;
    }
}