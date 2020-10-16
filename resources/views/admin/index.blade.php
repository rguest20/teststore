<x-app-layout>
    <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ 'Hello '. Auth::User()['name'] }}
                </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class = "text-3xl font-bold">Users found</h1>
                @foreach($results as $user)
                    <hr class="border">
                    <p>ID: {{ $user->id }}</p>
                    <p>Email: {{ $user->email }}</p>
                    @if (in_array($user->id, $admin))
                        <p>Admin: <input type = "checkbox" checked onclick="return false"></p>
                    @else
                        <p>Admin: <input type = "checkbox" name = "makeAdmin" onclick="return false"></p>
                        <p><button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type = 'button' onclick="window.location.href='./{{ $user->username }}/create'">Make Admin</button><button class = "ml-4 inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="button" onclick="window.location.href=('./{{  $user->username  }}/destroy')">Delete user</button></p>
                    @endif
                    <br>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
