<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $request) {
        $search = $request->search;
        if($search) {
            $escapedSearch = str_replace('%','\\%', $search);;
            $articles = Article::where('title','LIKE',"%{$escapedSearch}%")->get();
        } else {
            $articles = Article::all();
        }
        return view('feed.index', compact('articles'));
    }

    public function create() {
        return view('feed.create_article');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect('feed');
    }

    public function show($id) {
        $article = Article::findOrFail($id);
        return view('feed.show_article', compact('article'));
    }

    public function edit($id) {
        $article = Article::findOrFail($id);
        return view('feed.edit_article', compact('article'));
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required'
        ]);
        $article = Article::findOrFail($request->id);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->save();
        return view('feed.show_article', compact('article'));
    }

    public function destroy($id) {
        Article::findOrFail($id)->delete();
        return redirect('feed');
    }
}
