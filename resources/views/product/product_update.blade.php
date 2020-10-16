<?php
$tableEmpty= DB::table('admins')->count();
if ($tableEmpty == 0) {
    DB::table('admins')->insert(
        ['user_id' => \Illuminate\Support\Facades\Auth::id()]
    );
    echo 'You have been set as principal administrator as there are no other administrators currently';
}
$isadmin = DB::table('admins')->where('user_id', "=", Auth::id())->get();
$product= DB::table('products')->where('id', '=', $product)->get();
$productobj = $product[0];
?>
@if ($isadmin != "[]")
    <h1 class="text-lg font-bold"><a href="{{url('category/index')}}"><span class = "text-blue-800 underline"> Stock Control</span></a> |<a href="{{url('category/'.$category.'/products/index')}}"><span class = "text-blue-800 underline"> {{ $category }}</span></a> | Product Editor | {{ $productobj->product_name }}</h1>
    <br>
    </div>
    <div class="hidden sm:block">
        <div class="py-8">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">Update Product Information</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Update the information visible for the users then click submit.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form name="productupdate" method="POST" action="update">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-sm text-gray-700" for="name">New Product</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="name" id="name" type="text" value = "{{ $productobj->product_name }}" autocomplete=off required>
                                    <label class="block font-medium text-sm text-gray-700" for="description">Description</label>
                                    <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" name="description" id="description" required>{{ $productobj->product_description }}</textarea>
                                    <label class="block font-medium text-sm text-gray-700" for="price">Price</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="price" id="price" type="number"  min="0.01" step="0.01" max="25000" value = "{{ $productobj->price }}"required>
                                    <label class="block font-medium text-sm text-gray-700" for="units">Units</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="units" id="units" type="number"  min="0" step="1" max="25000" value = "{{ $productobj->units }}" required>
                                    <img src="{{ url( "storage/$productobj->image") }}" height = "450" width="500">
                                    <label class="block font-medium text-sm text-gray-700" for="image">Replace Image</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="image" id="image" type="file" value = {{ $productobj->image }}>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <input class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="submit" value="Save and Return">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@else
    <p>You do not have permissions to access this area. To gain permission, please contact the site administrator. Click <strong><a href='/'>HERE</a></strong> to go back.
    <p>
@endif
