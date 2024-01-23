<x-app-layout>
    <x-slot name="header">
        WEBアプリを探す
    </x-slot>
    <br>
    <div class="mx-auto max-w-7xl">
    <h2 class="rounded border bg-white items-center ">　キーワードで検索</h2><br>
    <div>
        <form action="{{ route('serch') }}" method="GET">
            <input type="text" name="keyword">
            <input type="submit" value="検索">
        </form>
    </div>
    <br>
    <h2 class="rounded border bg-white items-center">　カテゴリで検索</h2><br>
    @foreach ($categories as $category)
    <a class="rounded border bg-orange-500 hover:bg-yellow-300" href="/categories/{{ $category->id }}">{{ $category->name }}</a>
    @endforeach  
    <div class='posts'>
    <hr class="border-b5">
    <br>
        <h2 class="rounded border bg-white items-center">　おすすめの投稿</h2><br>
            @foreach ($posts as $post)
                <div class='post flex items-center max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg'>
                    <img src={{$post->ogp_url}} class="w-16 h-16">
                    <div>
                        <h1 class='title ml-4 text-blue-700 hover:underline'>
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </h1>
                        <div class='ml-4'>
                            @foreach ($post->categories as $category)
                                <a class="rounded border bg-emerald-500">{{ $category->name }}</a>
                            @endforeach
                            @foreach ($post->tags as $tag)
                                <a class="rounded border bg-emerald-500">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <p class='body ml-4 truncate'>{{ $post->body }}</p>
                    </div>
                </div>
                <br>
            @endforeach
    </div>
    <div class='paginate'>
        {{$posts->links()}}   
    </div>
</div>
</x-app-layout>