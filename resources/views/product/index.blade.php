<x-app-layout>
    <x-slot name="header">
        @if(Route::has('login'))
            @auth
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ 'Hello '. Auth::User()['name'] }}
                </h2>
            @else
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ 'Hello User' }}
                </h2>
            @endif
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @include('product.product_home')
        </div>
    </div>
</x-app-layout>
