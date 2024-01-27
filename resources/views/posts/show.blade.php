<x-app-layout>
    <x-slot name="header">
        <div class="text-2xl font-bold">{{ $post->title }}</div>
    </x-slot>
    <br>
    <div class="mx-auto max-w-7xl">
    <div class="ml-4">
        <div class="flex items-center">
            @if (strpos($post->ogp_url, '/') === 0)
                <div class="flex w-32 h-32 items-center justify-center bg-yellow-200 font-bold">{{ $post->title }}
                </div>
            @elseif($post->ogp_url)    
                <img src="{{ $post->ogp_url }}" class="w-32">
            @else
                <div class="flex w-32 h-32 items-center justify-center bg-cyan-200 font-bold">{{ $post->title }}
                </div>
            @endif
            <div class="ml-12">
                <h2 class="font-bold">投稿者</h2>
                <a>{{ $post->user->name }}</a>
                <h2 class="font-bold">URL</h2>
                <a href={{ $post->url }} class="text-blue-500 hover:underline">{{ $post->url }}</a>
            </div>    
        </div> <br>
        <div class="content">
            <h2 class="font-bold">{{ $post->title }}の説明</h2>
            <p class="rounded border bg-white p-2">{{ $post->body }}</p>    
        </div><br>
        <a class="font-bold">カテゴリ：</a>
        @foreach ($post->categories as $category)
            <a class="p-1 rounded border bg-emerald-500 hover:bg-yellow-300" href="/categories/{{ $category->id }}">{{ $category->name }}</a>
        @endforeach
        <br><br>
        <a class="font-bold">タグ：</a>
        @foreach ($post->tags as $tag)
            <a class="p-1 rounded border bg-emerald-500">{{ $tag->name }}</a>
        @endforeach
        <br><br>
        <p>ブックマーク登録数：{{$bookmarkCount}}件</p>
        <div class="flex items-center">
            @if (!Auth::user()->is_bookmark($post->id))
                <div class="font-bold">ブックマーク未登録 → </div>
                <form action="{{ route('bookmark.store', $post) }}" method="post">
                    @csrf
                    <button class="p-1 rounded border bg-orange-500 hover:bg-yellow-300">登録する</button>
                </form>
            @else
                <div class="font-bold">ブックマーク登録中 → </div>
                <form action="{{ route('bookmark.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="p-1 rounded border bg-white hover:bg-yellow-300">解除する</button>
                </form>
            @endif
        </div>    
        <br>
        @if(Auth::user()->id == $post->user_id)
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
            @csrf
            @method('DELETE')
            <button class="p-1 rounded border bg-white hover:bg-yellow-300" type="button" onclick="deletePost({{ $post->id }})">投稿削除</button>
        </form>
        @endif
        <script>
        function deletePost(id){
            'use strict'
            if (confirm('削除すると復元できません\n本当に削除しますか？')){
                document.getElementById(`form_${id}`).submit();
            }
        }
        </script>
    </div>
    </div>
</x-app-layout>