<x-app-layout>
    @php($cost = $product->price)
    @php($totalcost = $purchased*$cost)
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
                <p>User: {{ Auth::User()->email }}</p>
                <p>Product: {{ $product->product_name }}</p>
                <p>Quantity Bought: {{ $purchased }}</p>
                <p>Cost: £{{ $totalcost }}</p>
                <p>Product Remaining After Purchase: {{ $product->units }}</p>
                <p>This is a dummy function that would be used to add objects to the users basket. In 20 seconds this will return to the store front with changes updated.  In the event of a real store, I
                would create an object model "Basket" that is linked to one user.  This would be created alongside the user.  Product ids and quantities could be transferred into the basket and would be spoken
                for.  A Cron event could then empty the basket at the end of the day, restocking the virtual shelves.</p>
                <p>To return now click <strong><a href="{{ url('/dashboard') }}">HERE</a></strong>.</p>
            </div>
        </div>
        <script>
            setTimeout(function(){
                window.location.href = '{{ url("/dashboard")}}';
            }, 20000);
        </script>
</x-app-layout>
