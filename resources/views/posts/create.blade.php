<x-app-layout>
    <x-slot name="header">
        <div class="font-bold">おすすめのWEBアプリを投稿する</div>
    </x-slot>
    <br>
    <div class="mx-auto max-w-7xl">
    <div class="ml-6">
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2 class="font-bold">WEBアプリ名（必須）</h2>
                <input type="text" name="title" placeholder="" value="{{ old('title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('title') }}</p>
            </div>
            <div class="url">
                <h2 class="font-bold">URL（必須）</h2>
                <input type="text" name="url" placeholder="https://~~" value="{{ old('url') }}"/>
                <p class="url__error" style="color:red">{{ $errors->first('url') }}</p>
            </div>
            <div class="body">
                <h2 class="font-bold">WEBアプリの説明（必須）</h2>
                <textarea name="body" placeholder="">{{ old('body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('body') }}</p>
            </div><br>
            <div class="category">
                <h2 class="font-bold">カテゴリを選択（複数可）</h2>
                @foreach($categories as $category)
                <label>
                    <input type="checkbox" value="{{ $category->id }}" name="categories_array[]">
                        {{$category->name}}
                    </input>
                </label>
                @endforeach
                <br><br>
                <div class="flex items-center">
                    <p class="font-bold">その他キーワードがあれば入力してください</p>
                    <div class="max-w-max">
                        <p class="p-1 ml-4 rounded border bg-white hover:bg-yellow-300 add--btn">入力欄を追加する</p>
                    </div>
                </div>
                @csrf
                <input name="tag[0]" value="" type="text" placeholder="" class="add--form"/>
                
                <div class="form--area"></div>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"><br>
            <input class="font-bold rounded border bg-cyan-500 hover:bg-yellow-300 inline-block p-2" type="submit" value=" 投稿する ">
        </form>
    </div>
    </div>
    <script>
        const btnEl = document.querySelector('.add--btn');
        console.log('test',btnEl)
        btnEl.addEventListener('click',() => {
            const inputAllEl = document.querySelectorAll('.add--form');
            const formArea =  document.querySelector('.form--area');
            const createInputEl = document.createElement('input');
            createInputEl.type="text"
            createInputEl.placeholder=""
            createInputEl.className="add--form"
            createInputEl.name=`tag[${inputAllEl.length}]`
            formArea.appendChild(createInputEl);
        })
    </script>
</x-app-layout>