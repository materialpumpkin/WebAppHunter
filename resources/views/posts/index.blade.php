<x-app-layout>
    <x-slot name="header">
        WEBアプリを探す
    </x-slot>
    <h2>キーワードで検索</h2>
    <div>
        <form action="{{ route('serch') }}" method="GET">
            <input type="text" name="keyword">
            <input type="submit" value="検索">
        </form>
    </div>
    <h2>カテゴリで検索</h2>
    @foreach ($categories as $category)
    <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
    @endforeach    
    <div class='posts'>
        <h2>おすすめの投稿</h2>
            @foreach ($posts as $post)
                <div class='post'>
                    <h1 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h1>
                        @foreach ($post->categories as $category)
                            <p class='body'>{{ $category->name }}</p>
                        @endforeach
                    <p class='body'>{{ $post->body }}</p>
                </div>
            @endforeach
    </div>
    <div class='paginate'>
           
    </div>
</x-app-layout>