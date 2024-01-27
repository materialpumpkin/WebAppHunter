<x-app-layout>
    <x-slot name="header">
        <div class="font-bold">{{$keyword}} の検索結果</div>
    </x-slot>
    <br>
    <div class="mx-auto max-w-7xl">
    <br><br>
        @forelse ($posts as $post)
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
                    <h1 class='title ml-4 font-bold text-blue-700 hover:underline'>
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
        <h1 class="ml-8">検索結果はありません</h1>
        @endforelse
    <div class='paginate'>
        {{$posts->links()}}
    </div>
    </div>
</x-app-layout>