<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BookmarkController extends Controller
{
    public function store(Post $post) {
        $user = \Auth::user();
        if (!$user->is_bookmark($post->id)) {
            $user->bookmark_posts()->attach($post);
        }
        return redirect('/posts/'.$post->id);
    }
    public function destroy(Post $post) {
        
        $user = \Auth::user();
        if ($user->is_bookmark($post->id)) {
            $user->bookmark_posts()->detach($post);
        }
        return redirect('/posts/'.$post->id);
    }
}
