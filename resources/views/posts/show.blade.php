<x-app-layout>
    <h1 class="title">
        {{ $post->title }}
    </h1>
    <h2>投稿者</h2>
    <a href="">{{ $post->user->name }}</a>
    <h2>URL</h2>
    <p class='url'>{{ $post->url }}</p>
    <h2>カテゴリ</h2>
    @foreach ($post->categories as $category)
        <p class='body'>{{ $category->name }}</p>
    @endforeach
    <h2>タグ</h2>
    @foreach ($post->tags as $tag)
        <p class='body'>{{ $tag->name }}</p>
    @endforeach
    <div class="post-control">
        @if (!Auth::user()->is_bookmark($post->id))
            <h2>ブックマーク未登録</h2>
            <form action="{{ route('bookmark.store', $post) }}" method="post">
                @csrf
                <button>登録する</button>
            </form>
        @else
            <h2>ブックマーク登録中</h2>
            <form action="{{ route('bookmark.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <button>解除する</button>
            </form>
        @endif
    <div class="content">
        <div class="content__post">
            <h2>説明</h2>
            <p>{{ $post->body }}</p>    
        </div>
</x-app-layout>