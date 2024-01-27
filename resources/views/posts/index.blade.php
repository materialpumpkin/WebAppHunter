<x-app-layout>
    <x-slot name="header">
        <div class="font-bold">WEBアプリを探す</div>
    </x-slot>
    <br>
    <div class="mx-auto max-w-7xl">
    <h2 class="rounded border bg-gradient-to-r from-white to-blue-200 font-bold items-center p-2">　キーワードで検索</h2><br>
    <div>
        <form action="{{ route('serch') }}" method="GET">
            <input class="ml-2" type="text" name="keyword">
            <input class="font-bold rounded border bg-cyan-500 hover:bg-yellow-300 inline-block p-2" type="submit" value="検索">
        </form>
    </div>
    <br>
    <h2 class="rounded border bg-gradient-to-r from-white to-blue-200 font-bold items-center p-2">　カテゴリで検索</h2><br>
    @foreach ($categories as $cat)
    <a class="rounded-full border bg-lime-500 hover:bg-yellow-300 p-2" href="/categories/{{ $cat->id }}">{{ $cat->name }}</a>
    @endforeach  
    <div class='posts'>
    <br>
    <h2 class="rounded border bg-gradient-to-r from-white to-blue-200 font-bold items-center p-2">　キーワード＋カテゴリで検索</h2><br>
        <form class= "flex" action="{{ route('doubleSearch')}}" method="GET">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control ml-2" placeholder="キーワードを入力">
            </div>
            <div class="form-group">
                <select name="category" id="category" class="form-control ml-2">
                    <option class="font-bold" value="" disabled selected>カテゴリを選択</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="ml-2 font-bold rounded border bg-cyan-500 hover:bg-yellow-300 inline-block p-2 btn btn-primary" id="searchButton" disabled>検索</button>
        </form>
    <br>
    <h2 class="rounded border bg-gradient-to-r from-white to-blue-200 font-bold items-center p-2">　おすすめの投稿</h2><br>
        @foreach ($posts as $post)
            <div class='post flex items-center max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg'>
                @if (strpos($post->ogp_url, '/') === 0)
                    <div class="flex w-16 h-16 items-center justify-center bg-yellow-200">▶
                    </div>
                @elseif($post->ogp_url)    
                    <img src="{{ $post->ogp_url }}" class="w-16">
                @else
                    <div class="flex w-16 h-16 items-center justify-center bg-cyan-200">▶
                    </div>
                @endif
                <div>
                    <h1 class='title ml-4 text-blue-700 font-bold hover:underline'>
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
    <div class='paginate'>
        {{$posts->links()}}   
    </div>
</div>
<script>
    document.getElementById('category').addEventListener('change', function() {
        var button = document.getElementById('searchButton');
        button.disabled = this.value === '';
    });
</script>
</x-app-layout>