<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function () {

    $posts = Post::with('user')->latest()->get();

    return view('posts.index', compact('posts'));

});

Route::post('/posts', function (Request $request) {

    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    Post::create([
        'user_id' => 1,
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect('/posts');

});
