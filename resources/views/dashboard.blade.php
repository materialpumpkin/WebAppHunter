<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ようこそ！') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    世の中には有用なウェブアプリが無数にあります。<br>
                    このWEBアプリはあなたにとって便利なWEBアプリの情報の収集を手助けします。<br>
                    「探す」ではWEBアプリの情報を検索することができ、お気に入りのものは「ブックマーク」ページから簡単にアクセスできます。<br>
                    また、自分のお気に入りは「投稿する」でほかの人に共有することができます。
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
