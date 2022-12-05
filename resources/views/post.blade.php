<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание поста') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('post.create') }}" method="post">
                        @csrf
                        @method('patch')
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Название калькулятора
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="name" type="text" name="name" required="required" autofocus="autofocus">
                        
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Описание
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="description" type="text" name="description" required="required" autofocus="autofocus">
                        
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Формула отображения
                        </label>
                        <input onchange="alert(this.value)" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="view_formula" type="text" name="view_formula" required="required" autofocus="autofocus">
                        <script>
                            function alert(text) {
                                text = '\\['+text+'\\]';
                                var element = document.getElementsByClassName('content')[0];
                                element.innerHTML = text; 
                                renderMathInElement(element);
                            }
                        </script>
                        <div class="content"></div>

                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Формула
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="formula" type="text" name="formula" required="required" autofocus="autofocus">
                        
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Входные переменные через пробел
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="input_variables" type="text" name="input_variables" required="required" autofocus="autofocus">
                        
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Выходные переменные
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="output_variables" type="text" name="output_variables" required="required" autofocus="autofocus">
                        
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Тэги через пробел
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="tags" type="text" name="tags" required="required" autofocus="autofocus">
                        
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                Создать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
