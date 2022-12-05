<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Формулы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="GET" action="{{ route('post.search') }}">
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" placeholder="Введите поисковой запрос" id="question" type="text" name="question" required="required" autofocus="autofocus">
                    </form>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($posts->tags as $tag)
                        <a href="{{ route('post.search_tag', $tag->tag) }}"><span class="tag">{{$tag->tag}}</span></a>
                    @endforeach
                </div>

                <div class="card">
                    @foreach($posts as $post)
                        <div class="p-7 bg-white bg-gray-100 mini_card">
                            <p class="name">{{$post->name}}</p>
                            <a class="formula_6N6bI" href="{{ route('post.show', $post->id)  }}">\[{{$post->view_formula}}\]</a>
                            <div class="rating-result">Рейтинг:
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i<$post['rating'])
                                        <span class="active"></span>
                                    @else
                                        <span></span>   
                                    @endif
                                @endfor
                            </div>
                            <p class="tags">
                                @foreach ($post->tags as $tag)
                                    <span class="tag">{{$tag}}</span>
                                @endforeach
                            </p>
                            @auth
                                @if(Auth::user()->id===$post->author_id||Auth::user()->role->name==='Администратор')
                                    <a class="destroy_post" href="{{ route('post.destroy',['post'=>$post->id]) }}">Удалить</a>
                                    <a class="update_post" href="{{ route('post.edit',['post'=>$post->id]) }}">Редактировать</a>
                                @endif
                            @endauth

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
