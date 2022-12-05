<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Панель администратора') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.search_user') }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Введите имя пользователя" id="question" type="text" name="question" required="required" autofocus="autofocus">
                    </form>
                </div>
                <div class="spisok">
                    @foreach($data['users'] as $user)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p>{{$user->name}}</p>
                            <a class="destroy_post" href="{{ route('admin.user_destroy',['user'=>$user->id]) }}">Удалить</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.search_post') }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Введите название калькулятора" id="question" type="text" name="question" required="required" autofocus="autofocus">
                    </form>
                </div>
                <div class="spisok">
                    @foreach($data['posts'] as $post)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p>{{$post->name}}</p>
                            <a class="destroy_post" href="{{ route('admin.post_destroy',['post'=>$post->id]) }}">Удалить</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.search_tag') }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Введите тег" id="question" type="text" name="question" required="required" autofocus="autofocus">
                    </form>
                </div>
                <div class="spisok">
                    @foreach($data['tags'] as $tag)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p>{{$tag->tag}}</p>
                            <a class="destroy_post" href="{{ route('admin.tag_destroy',['tag'=>$tag->id]) }}">Удалить</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
