<x-app-layout>
    <h1 class="title">
        {{ $post->title }}
    </h1>
    <h2>投稿者</h2>
    <h2>URL</h2>
    <p class='url'>{{ $post->url }}</p>
    <h2>カテゴリ</h2>
    @foreach ($post->categories as $category)
        <p class='body'>{{ $category->name }}</p>
    @endforeach
    <div class="content">
        <div class="content__post">
            <h2>本文</h2>
            <p>{{ $post->body }}</p>    
        </div>
</x-app-layout>