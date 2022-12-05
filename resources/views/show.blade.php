<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Формула') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="rating-result">Рейтинг:
                        @for($i = 0; $i < 5; $i++)
                            @if ($i<$post['rating'])
                                <span class="active"></span>
                            @else
                                <span></span>   
                            @endif
                        @endfor
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{$post->name}}</h2>
                    <p>{{$post->description}}</p>
                    <p class="formula_6N6bI">\[{{$post->view_formula}}\]</p>
                </div>
                <div class="base border-b">
                    <div class="p-6 bg-white border-r border-gray-200 left_blok">
                        <p>Входные данные</p>
                        <form action="#" id ="variablesform">
                            @foreach($post['input_variables'] as $poster)
                                <p class="formula_6N6bI">\[{{$poster}}=\]</p>
                                <input class="variable rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id={{$poster}} type="text" name="{{$poster}}" required="required" autofocus="autofocus">
                            @endforeach
                            <div class="flex items-center justify-end mt-4">
                                <input value="Вычислить"  type="button" onclick="Sf()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                            </div> 
                        </form>
                        <p class="formula_6N6bI">\[{{$post['output_variables']}}=\]</p>
                        <input type="text" id="answer" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                    </div>

                    <div class="p-6 bg-white border-gray-200 right_blok">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <form action="{{ route('post.rating',['post'=>$post->id]) }}" >
                                @csrf
                                <p>Ваша оценка:</p>
                                <div class="rating-area">
                                    <input type="radio" id="star-5" name="rating" value="5">
                                    <label for="star-5" title="Оценка «5»"></label>	
                                    <input type="radio" id="star-4" name="rating" value="4">
                                    <label for="star-4" title="Оценка «4»"></label>    
                                    <input type="radio" id="star-3" name="rating" value="3">
                                    <label for="star-3" title="Оценка «3»"></label>  
                                    <input type="radio" id="star-2" name="rating" value="2">
                                    <label for="star-2" title="Оценка «2»"></label>    
                                    <input type="radio" id="star-1" name="rating" value="1">
                                    <label for="star-1" title="Оценка «1»"></label>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                        Оставить
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="p-6 bg-white border-gray-200">
                            <p>Теги:</p>
                            @foreach ($post->tags as $tag)
                            <span class="tag">{{$tag}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                

                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('post.comment',['post'=>$post->id]) }}" method="post">
                        @csrf
                        @method('patch')
                        <p>Ваш комментарий:</p>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="comment" type="text" name="comment" required="required" autofocus="autofocus">        

                    </form>
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Комментарии:</p>
                    @foreach ($post['comments'] as $item)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p>{{$item->author->name}}</p>
                            <p>{{$item['comment']}}</p>
                            @auth
                                @if (Auth::user()->id===$item->user_id||Auth::user()->role->name==='Администратор')
                                    <a class="destroy_post" href="{{ route('post.destroy_comment',['post'=>$post->id,'comment'=>$item->id]) }}">Удалить</a>
                                @endif                                
                            @endauth

                        </div>   
                    @endforeach
                </div>

                <script>
                    function getFormVariables(formID) {
                        var inputs = $(formID).children(".variable");
                        const variables = new Object();

                        for (const input of Object.entries(inputs)) {
                            variables[input[1].name] = parseInt(input[1].value);
                        }

                        return variables;
                    }
                     
                    function Sf() {
                        var variables = getFormVariables("#variablesform");
                        console.log(variables);
                        var fn = evaluatex("{{ $post->formula }}", variables, { latex: true });
                        $('#answer').val(fn());
                    }
                </script>

            </div>
        </div>
    </div>
</x-app-layout>