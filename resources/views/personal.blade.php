<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Личный кабинет') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('personal.changename') }}" method="post">
                        @csrf
                        @method('patch')
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Поменять имя
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="name" type="text" name="name" required="required" autofocus="autofocus">
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                Изменить
                            </button>
                        </div>
                    </form>
                    <form action="{{ route('personal.changeemail') }}" method="post">
                        @csrf
                        @method('patch')
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Поменять почту
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="email" type="text" name="email" required="required" autofocus="autofocus">
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                Изменить
                            </button>
                        </div>
                    </form>
                    <form action="{{ route('personal.changepassword') }}" method="post">
                        @csrf
                        @method('patch')
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Старый пароль
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="old_password" type="text" name="old_password" required="required" autofocus="autofocus">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Новый пароль
                        </label>
                        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="new_password" type="text" name="new_password" required="required" autofocus="autofocus">
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                Изменить
                            </button>
                        </div>
                    </form>
                    <div >
                    
                        <a class="destroy_post" href="{{ route('admin.user_destroy',['user'=>Auth::user()->id]) }}">Удалить свой аккаунт</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
