<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


class PostController extends Controller
{
    public function index(Post $post, Category $category)
    {
        $categories = Category::all();
        $post = Post::withCount('bookmarks')
                    ->orderBy('bookmarks_count','DESC')
                    ->paginate(10);
        
         return view('posts.index')->with([
            'posts' => $post,
            'categories'=>$categories
        ]);
    }

    public function serch(Post $post, Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                      ->orWhereHas('tags', function ($query) use ($keyword) {
                          $query->where('name', 'LIKE', "%{$keyword}%");
                      });
            });
        }
        $posts = $query->get();
        
        return view('posts.serch')->with([
            'posts' => $posts,
            'keyword' => $keyword
        ]);
    }
    public function show(Post $post)
    {
        $bookmarkCount = $post->bookmarks()->count();
        return view('posts.show',compact('post', 'bookmarkCount'));
    }
   
    public function store (PostRequest $request, Post $post)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $request->url);
        $crawler = new Crawler($response->getBody()->getContents());

        $ogp = $crawler->filter('meta[property="og:image"]')->attr('content');
        $post->ogp_url = $ogp;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->url = $request->url;
        $post->save();
        
        $input_categories=$request->categories_array;
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
    public function getOgp(Post $post)
    {
        
    }
}