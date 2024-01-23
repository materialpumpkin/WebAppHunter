<x-app-layout>
    <x-slot name="header">
        {{ $post->title }}
    </x-slot>
    <img src={{$post->ogp_url}} class="w-32 h-32">
    <h2>投稿者</h2>
    <a>{{ $post->user->name }}</a>
    <h2>URL</h2>
    <p helf={{ $post->url }} class="text-blue-500 hover:underline">{{ $post->url }}</p>
    <div class="content">
        <h2>説明</h2>
        <p>{{ $post->body }}</p>    
    </div>
    <h2>カテゴリ</h2>
    @foreach ($post->categories as $category)
    <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
    @endforeach
    <h2>タグ</h2>
    @foreach ($post->tags as $tag)
        <a class='tag'>{{ $tag->name }}</a>
    @endforeach
    <p>ブックマーク登録：{{$bookmarkCount}}件</p>
    <div class="post-control">
        @if (!Auth::user()->is_bookmark($post->id))
            <div>ブックマーク未登録</div>
            <form action="{{ route('bookmark.store', $post) }}" method="post">
                @csrf
                <button>登録する</button>
            </form>
        @else
            <div>ブックマーク登録中</div>
            <form action="{{ route('bookmark.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <button>解除する</button>
            </form>
        @endif
    @if(Auth::user()->id == $post->user_id)
    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
        @csrf
        @method('DELETE')
        <button type="button" onclick="deletePost({{ $post->id }})">投稿削除</button>
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
</x-app-layout>