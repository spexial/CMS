<?php

namespace App\Listeners;

use App\Article;
use App\Events\ArticleEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleListener
{

    /**
     * Handle the event.
     *
     * @param  ArticleEvent  $event
     * @return void
     */
    public function handle(ArticleEvent $event)
    {
        $article = Article::find($event->article->id);
        $article->view += 1;
        $article->save();
    }
}
