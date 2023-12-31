<x-app-layout>
    <x-slot name="header">
        おすすめのWEBアプリを投稿する
    </x-slot>
    <form action="/posts" method="POST">
        @csrf
        <div class="title">
            <h2>WEBアプリ名</h2>
            <input type="text" name="post[title]" placeholder="" value="{{ old('post.title') }}"/>
            <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
        </div>
        <div class="url">
            <h2>URL</h2>
            <input type="text" name="post[url]" placeholder="" value="{{ old('post.url') }}"/>
            <p class="title__error" style="color:red">{{ $errors->first('post.url') }}</p>
        </div>
        <div class="body">
            <h2>WEBアプリの説明</h2>
            <textarea name="post[body]" placeholder="">{{ old('post.body') }}</textarea>
            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
        </div>
        <div class="category">
            <h2>カテゴリを選択</h2>
            @foreach($categories as $category)
            <label>
                <input type="checkbox" value="{{ $category->id }}" name="categories_array[]">
                    {{$category->name}}
                </input>
            </label>
            @endforeach
            <p>その他　自由入力</p>
            <input type="text" name="post[category]" placeholder="" value="{{ old('post.category') }}" />
            <input type="text" name="post[category]" placeholder="" value="{{ old('post.category') }}" />
            <input type="text" name="post[category]" placeholder="" value="{{ old('post.category') }}" />
        </div>
        <input type="hidden" name="post[user_id]" value="{{ Auth::user()->id }}">
        <input type="hidden" name="post[ogp_url]" value="{{ Auth::user()->name }}">
        <input type="submit" value="投稿"/>
    </form>
</x-app-layout>