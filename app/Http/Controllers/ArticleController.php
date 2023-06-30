<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use App\Models\Tag;
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
        if(auth()->user()->cannot('create', Article::class)) {
            return back();
        }
        $tags = Tag::all();
        return view('feed.create_article', compact('tags'));
    }

    public function store(Request $request) {
        if(auth()->user()->cannot('create', Article::class)) {
            return back();
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required|array|min:2|max:4',
            'content' => 'required'
        ]);
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->user_id = $request->user()->id;
        $article->save();

        $article->tags()->attach($request->tags);

        return redirect('feed');
    }

    public function show($id) {
        $article = Article::findOrFail($id);
        $reviews = Review::where('article_id', $id)->get();
        return view('feed.show_article', compact('article', 'reviews'));
    }

    public function edit($id) {
        $article = Article::findOrFail($id);
        if(auth()->user()->cannot('update', $article)) {
            return back();
        }
        $tags = Tag::all();
        $selectedTags = $article->tags()->pluck('title')->toArray();
        return view('feed.edit_article', compact('article', 'tags', 'selectedTags'));
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required|array|min:2|max:4',
            'content' => 'required'
        ]);
        $article = Article::findOrFail($request->id);
        if(auth()->user()->cannot('update', $article)) {
            return back();
        }
        $article->title = $request->title;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->save();

        $article->tags()->sync($request->tags);

        return redirect()->route('feed.show_article', ['id' => $request->id])->with('success', 'Article updated');
    }

    public function destroy($id) {
        $article = Article::findOrFail($id);
        if(auth()->user()->cannot('delete', $article)) {
            return back();
        }
        $article->delete();
        return redirect('feed');
    }
}
