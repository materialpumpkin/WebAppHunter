<x-app-layout>
    <div class='posts'>
        <h2>カテゴリの投稿</h2>
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