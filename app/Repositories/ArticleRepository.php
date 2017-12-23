<?php  namespace App\Repositories;


use App\Article;


class ArticleRepository extends PublicRepository
{

    public function __construct(Article $article)
    {
        parent::__construct($article);
    }


}