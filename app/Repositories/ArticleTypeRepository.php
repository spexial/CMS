<?php namespace App\Repositories;


use App\ArticleType;

class ArticleTypeRepository extends PublicRepository
{
    /**
     * ArticleTypeRepository constructor.
     * @param ArticleType $articleType
     */
    public function __construct(ArticleType $articleType)
    {
        parent::__construct($articleType);
    }


}