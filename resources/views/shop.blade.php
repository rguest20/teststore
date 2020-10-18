<div class="p-6 sm:px-20 bg-red border-b border-gray-200">


    <div class="mt-8 text-2xl text-center font-bold">
        Ryan Guest's Totally Real And Not In Any Way Made Up PC's
    </div>

    <div class="mt-6 text-gray-500 text-center">
        <small>Your computer IS our business</small>
    </div>
</div>
</div>
<div class="mt-4 border bg-opacity-25 grid grid-cols-1">
        @php($category = \Illuminate\Support\Facades\DB::table('categories')->get())
        @foreach ($category as $cat)
        <div class="p-6 border bg-gray-200">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">{{ $cat->category_name }}</div>
            </div>
            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                    {{ $cat->category_description }}
                </div>
            </div>
        </div>
        <div class="p-6 border bg-white">
            @php($prod = (\Illuminate\Support\Facades\DB::table('products')->where('category_id', $cat->id)->get()))
            <div class="flex grid grid-cols-2 md:grid-cols-3 text-center">
            @foreach($prod as $product)
                <div class="justify-center border ml-4 text-lg text-gray-600 leading-7 font-semibold"><img class="mx-auto" src="{{ url( "storage/$product->image") }}"> {{ $product->product_name }}
                    <div class="mt-2 text-sm text-gray-500">
                        <h3 class="underline">Description</h3>
                        <p>{{ $product->product_description }}</p>
                        <p>Price: £{{ $product->price }} </p>
                        <p>
                        <form method="post" action="product/{{ $product->id }}/buy">
                            @csrf
                            <label for="number">Number to buy: </label>
                            <input type="number" name="number" id="number" class="w-12" min="1" max="{{ $product->units }}" step="1" value="1">
                            <button class = "w-16 inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="submit">Buy</button></form> </p>
                        <p>Units left: {{$product->units}}</p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    @endforeach
</div>
