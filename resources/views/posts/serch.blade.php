<x-app-layout>
    <x-slot name="header">
        {{$keyword}} の検索結果
    </x-slot>
    <br>
        @forelse ($posts as $post)
            <div class='post flex items-center max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg'>
            <img src={{$post->ogp_url}} class="w-16 h-16">
                <div>
                    <h1 class='title ml-4'>
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
        @empty
        <h1>検索結果はありません</h1>
        @endforelse
    <div class='paginate'>
        
    </div>
</x-app-layout>