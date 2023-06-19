<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleItem extends Component
{
    public $article;
    public $author;
    public $access;
    
    /**
     * Create a new component instance.
     */
    public function __construct($article)
    {
        $this->article = $article;
        $this->author = $article->author()->get()[0];
        $this->access = (($this->author->blocked)? ' [blocked]' : '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-item');
    }
}
