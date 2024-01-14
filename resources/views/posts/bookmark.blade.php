<x-app-layout>
    <x-slot name="header">
        ブックマークしたWEBアプリ一覧
    </x-slot>
    <div class='posts'>
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
    {{ $posts->links()}}
</x-app-layout>