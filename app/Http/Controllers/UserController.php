<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request) {
        $search = $request->search;
        if($search) {
            $escapedSearch = str_replace('%','\\%',$search);
            $users = User::where('name','LIKE',"%{$escapedSearch}%")->get();
        } else {
            $users = User::all();
        }
        return view('users.index', compact('users'));
    }

    public function show($id, Request $request) {
        $user = User::findOrFail($id);
        $articlesQuery = $user->articles();
        $search = $request->search;
        if($search) {
            $escapedSearch = str_replace('%','\\%', $search);
            $articles = $articlesQuery->where('title','LIKE',"%{$escapedSearch}%")->get();
        } else {
            $articles = $articlesQuery->get();
        }
        $interests = $user->tags()->pluck('title')->toArray();
        return view('users.show', compact('user','articles', 'interests'));
    }

    public function interests($id) {
        $user = User::findOrFail($id);
        if (auth()->user()->cannot('edit_interests', User::class) || auth()->user()->id !== $user->id) {
            return back();
        }
        $tags = Tag::all();
        $selectedTags = $user->tags()->pluck('title')->toArray();
        return view('users.interests', compact('tags', 'selectedTags'));
    }

    public function updateInterests(Request $request) {
        $request->validate([
            'tags' => 'required|array|min:3|max:5',
        ]);

        $user = User::findOrFail(auth()->id());

        $user->tags()->sync($request->tags);

        return redirect()->route('users.show', ['id' => auth()->id()]);
    }

    public function contributions($id) {
        $user = User::findOrFail($id);
        return view('users.contributions', compact('user'));
    }

    public function access($id) {
        $user = User::findOrFail($id);
        if(auth()->user()->cannot('update', $user)) {
            return back();
        }
        $user->save();
        $articles = $user->articles()->get();
        return view('users.show', compact('user','articles'));
    }

    public function followers($id) {
        $user = User::find($id);
        $followers = $user->followers()->get();
        return view('users.followers', compact('followers', 'user'));
    }

    public function following($id) {
        $user = User::find($id);
        $followings = $user->following()->get();
        return view('users.following', compact('followings', 'user'));
    }

    public function follow($id) {
        $user = User::find($id);

        if(auth()->user()->cannot('follow', $user)) {
           return back();
        }

        $currentUser = auth()->user();

        if (!$currentUser) {
            return redirect()->back()->with('error', 'You must be authenticated to perform this action.');
        }

        if($currentUser->id == $user->id){
            return redirect()->back()->with('error', 'You cannot follow yourself.');
        }

        if ($currentUser->following->contains($user->id)) {
            $currentUser->following()->detach($user->id);
            return redirect()->back()->with('success', 'You have now unfollowed this user');
        } else {
            $currentUser->following()->attach($user->id);
            return redirect()->back()->with('success', 'You are now following this user');
        }
    }
}
