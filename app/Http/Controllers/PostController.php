<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(10)]);
        $client = new \GuzzleHttp\Client();
        $url = 'https://teratail.com/api/v1/questions';
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        $questions = json_decode($response->getBody(), true);
        return view('posts.index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
   
    public function store (PostRequest $request, Post $post)
    {
        $input_post=$request['post'];
        $input_categories=$request->categories_array;
        $post->fill($input_post)->save();
        foreach ($request->tag as $tagEl) {
            $tag = new Tag();
            $tag->name = $tagEl;
            $tag->post_id = $post->id;
            $tag->save();
        }
        $post->categories()->attach($input_categories);
        return redirect('/posts/' . $post->id);
    }
    public function edit (Post $post)
    {
        return view('posts/edit')->with(['post'=>$post]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }
    public function test(Post $post)
    {
        return view('posts.bookmark')->with(['post' => $post]);
    }
    public function bookmark_posts()
    {
        $posts = \Auth::user()->bookmark_posts()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts
        ];
        return view('posts.bookmark')->with(['posts' => $posts]);
    }
}