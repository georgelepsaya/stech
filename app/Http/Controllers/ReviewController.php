<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Notification;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create($article_id) {
        return view('reviews.create_review', compact('article_id'));
    }

    public function show($id) {
        $review = Review::findOrFail($id);
        return view('reviews.show_review', compact('review'));
    }

    public function edit($id) {
        $review = Review::findOrFail($id);
        return view('reviews.edit_review', compact('review'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:5',
            'rating' => 'required|between:1,10',
            'text' => 'required|min:50',
        ]);

        $review = new Review();
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->text = $request->text;
        $review->article_id = $request->article_id;
        $review->author_id = $request->user()->id;

        $review->save();

        $article_author_id = Article::where('id', $request->article_id)->pluck('user_id')->toArray()[0];

        Notification::create([
            'user_id' => $article_author_id,
            'source_id' => $review->author_id,
            'source_type' => \App\Models\User::class,
            'subject_id' => $review->id,
            'subject_type' => \App\Models\Review::class,
            'notification_type' => 'left_review',
        ]);

        return redirect('feed/articles/' . $request->article_id);
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required|min:5',
            'rating' => 'required|between:1,10',
            'text' => 'required|min:50',
        ]);
        $review = Review::findOrFail($request->id);
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->text = $request->text;
        $review->save();
        return redirect()->route('reviews.show', ['id' => $request->id]);
    }

    public function destroy($id) {
        $review = Review::findOrFail($id);
        $articleId = $review->article_id;
        $review->delete();
        return redirect()->route('feed.show_article', ['id' => $articleId]);
    }
}
