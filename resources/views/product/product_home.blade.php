<?php
$tableEmpty= DB::table('admins')->count();
if ($tableEmpty == 0) {
    DB::table('admins')->insert(
        ['user_id' => \Illuminate\Support\Facades\Auth::id()]
    );
    echo 'You have been set as principal administrator as there are no other administrators currently';
}
$isadmin = DB::table('admins')->where('user_id', "=", Auth::id())->get();
$catid = \Illuminate\Support\Facades\DB::table('categories')->where('category_name', $category)->get();
$products = \Illuminate\Support\Facades\DB::table('products')->where('category_id', $catid[0]->id)->get();
?>
@if ($isadmin != "[]")
    <h1 class="text-lg font-bold"><a href="../../index"><span class = "text-blue-800 underline"> Stock Control</span></a> | {{ $category }} | Products</h1>
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
                    <h3 class="text-lg font-medium text-gray-900">Create New Product</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Write in the name/details of the product you would like to create, it will appear below
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form name="createproduct" method="POST" action="create" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-sm text-gray-700" for="name">New Product</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="name" id="name" type="text" autocomplete="name" required>
                                    <label class="block font-medium text-sm text-gray-700" for="description">Description</label>
                                    <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" name="description" id="description" required></textarea>
                                    <label class="block font-medium text-sm text-gray-700" for="price">Price</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="price" id="price" type="number"  min="0.01" step="0.01" max="25000" required>
                                    <label class="block font-medium text-sm text-gray-700" for="units">Units</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="units" id="units" type="number"  min="0" step="1" max="25000" required>
                                    <label class="block font-medium text-sm text-gray-700" for="image">Image</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="image" id="image" type="file">
                                    <input type="text" name = "cat_id" value = "{{$catid[0]->id}}" hidden>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <input class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">List Of Products In This Category</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Edit Details, Stock Information
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <p>PRODUCT NAME<span class="float-right">ACTIONS</span></p>
                <hr>
                @foreach($products as $product)
                    <p class="mt-4 mb-2 justify-text-center"><strong class="relative bottom-1">{{ $product->product_name }}</strong> <img class= "inline" src="{{ url( "storage/$product->image") }}" height="40" width = '40'> <span class = "float-right relative bottom-3">
                            <button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="button" onclick="window.location.href='{{ $product->id }}/edit'">More Detail</button>
                            <button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="button" onclick="window.location.href='{{ $product->id }}/delete'">Delete</button></span> </p>
                    <form class="inline-block" method="post" action = "{{ $product->id }}/addstock">
                        @csrf
                        <p>Current stock: {{ $product->units }}</p><input class = "border mr-4" type="number" value="1" min="1" max="100000" step="1" name="number" class="w-12" autocomplete="off"> <button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="submit">Add Stock</button>
                    </form>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@else
    <p>You do not have permissions to access this area. To gain permission, please contact the site administrator. Click <strong><a href='/'>HERE</a></strong> to go back.
    <p>
@endif
