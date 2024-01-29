<x-app-layout>
    <x-slot name="header">
        <div class="font-bold">ブックマークしたWEBアプリ一覧</div>
    </x-slot>
    <br>
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post flex h-20 items-center max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg'>
                @if (strpos($post->ogp_url, '/') === 0)
                    <div class="flex-shrink-0 flex w-16 h-16 items-center justify-center bg-yellow-200">▶
                    </div>
                @elseif($post->ogp_url)    
                    <img src="{{ $post->ogp_url }}" class="flex-shrink-0 w-16">
                @else
                    <div class="flex-shrink-0 flex w-16 h-16 items-center justify-center bg-cyan-200">▶
                    </div>
                @endif
                <div>
                    <h1 class='title ml-4 text-blue-700 font-bold hover:underline'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h1>
                    <a href="{{ $post->url }}" class='ml-4 truncate text-blue-500 hover:underline'>{{ $post->url }}</a>
                    <div class='ml-4'>
                        @foreach ($post->categories as $category)
                            <a class="rounded border bg-emerald-500">{{ $category->name }}</a>
                        @endforeach
                        @foreach ($post->tags as $tag)
                            <a class="rounded border bg-emerald-500">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>
    {{ $posts->links()}}
</x-app-layout>