<x-app-layout>
    <h2>検索結果</h2>
        @forelse ($posts as $post)
           <div class='post'>
                <h1 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h1>
                    @foreach ($post->categories as $category)
                        <p class='body'>{{ $category->name }}</p>
                    @endforeach
                <p class='body'>{{ $post->body }}</p>
            </div>
            
        @empty
        <h1>検索結果はありません</h1>
        @endforelse
    
    
    <div class='paginate'>
        
    </div>
</x-app-layout>