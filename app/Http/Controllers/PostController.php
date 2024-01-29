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
use GuzzleHttp\Exception\RequestException;



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

    public function serch(Category $category, Request $request)
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
        $posts = $query->paginate(10);
        $categories = Category::all();
        
        return view('posts.serch', compact('posts', 'categories', 'keyword'));
    }
    public function show(Post $post)
    {
        $bookmarkCount = $post->bookmarks()->count();
        return view('posts.show',compact('post', 'bookmarkCount'));
    }
   
    public function store (PostRequest $request, Post $post)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $request->url);
            $crawler = new Crawler($response->getBody()->read(1957)->getContents());

           $favicon = $crawler->filter('link[rel="icon"], link[rel="shortcut icon"]')->first();
    
            if ($favicon->count() > 0) {
                $faviconUrl = $favicon->attr('href');
                
                if (strpos($faviconUrl, '/') === 0) {
                    $faviconUrl = null;
                }
    
                $maxResolution = 0;
                $maxResolutionUrl = $faviconUrl;
                $links = $crawler->filter('link[rel="icon"], link[rel="shortcut icon"],link[rel="apple-touch-icon"]');
                foreach ($links as $link) {
                    $sizeAttr = $link->getAttribute('sizes');
                    if ($sizeAttr) {
                        preg_match('/(\d+)x(\d+)/', $sizeAttr, $matches);
                        if (isset($matches[1]) && isset($matches[2])) {
                            $resolution = max($matches[1], $matches[2]);
                            if ($resolution > $maxResolution) {
                                $maxResolution = $resolution;
                                $maxResolutionUrl = $link->getAttribute('href');
                            }
                        }
                    }
                }
    
                $faviconUrl = $maxResolutionUrl;
            } else {
                $ogpImage = $crawler->filter('meta[property="og:image"]');
                if ($ogpImage->count() > 0) {
                    $faviconUrl = $ogpImage->attr('content');
                } else {
                    $faviconUrl = null;
                }
            }
            } catch (RequestException $e) {
                $faviconUrl = null;
            }
            
            // $ogp = $crawler->filter('meta[property="og:image"]');
        
            // if ($ogp->count() > 0) {
            //     $ogpUrl = $ogp->attr('content');
            // } else {
            //     $ogpUrl = null;
            // }
        // } catch (RequestException $e) {
        //     $ogpUrl = null;
        // }
        $post->ogp_url = $faviconUrl;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->url = $request->url;
        $post->save();
        
        $input_categories=$request->categories_array;
        foreach ($request->tag as $tagEl) {
            $tag = new Tag();
            
            if($tagEl !== null){
                $tag->name = $tagEl;
                $tag->post_id = $post->id;
                $tag->save();
            }
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