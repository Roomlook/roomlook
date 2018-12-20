<?php
namespace App\Models;

class Article extends \Pingpong\Admin\Entities\Article
{
    public $translationModel = 'App\Models\ArticleTranslation';
    
}
