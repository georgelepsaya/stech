<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

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
        return view('users.show', compact('user','articles'));
    }

    public function access($id) {
        $user = User::findOrFail($id);
        $user->blocked = (($user->blocked)? 0 : 1);
        $user->save();
        $articles = $user->articles()->get();
        return view('users.show', compact('user','articles'));
    }
}
