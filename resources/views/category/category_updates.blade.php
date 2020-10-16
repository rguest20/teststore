<?php
$tableEmpty= DB::table('admins')->count();
if ($tableEmpty == 0) {
    DB::table('admins')->insert(
        ['user_id' => \Illuminate\Support\Facades\Auth::id()]
    );
    echo 'You have been set as principal administrator as there are no other administrators currently';
}
$isadmin = DB::table('admins')->where('user_id', "=", Auth::id())->get();

$categories = \Illuminate\Support\Facades\DB::table('categories')->get()
?>
@if ($isadmin != "[]")
    <h1 class="text-lg font-bold">Stock Control | Categories Panel</h1>
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
                    <h3 class="text-lg font-medium text-gray-900">Create New Category</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Write in the name of the category you would like to create, it will appear below
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form name="queryadmin" method="POST" action="create">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-sm text-gray-700" for="name">New Category</label>
                                    <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="name" id="name" type="text" autocomplete="name" required>
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
                    <h3 class="text-lg font-medium text-gray-900">List Of Categories</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Add description, Add/Remove products,Delete category.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <p>CATEGORY NAME<span class="float-right">ACTIONS</span></p>
                <hr>
                @foreach($categories as $cat)
                    <p class="mt-4 mb-2 justify-text-center"><strong class="relative bottom-1">{{ $cat->category_name }}</strong> <span class = "float-right relative bottom-3"><button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="button" onclick="window.location.href='{{ $cat->category_name }}/edit'">More Detail</button> <button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="button" onclick="window.location.href='{{ $cat->category_name }}/products/index'">Products</button> <button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="button" onclick="window.location.href='{{ $cat->category_name }}/delete'">Delete</button></span> </p>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@else
    <p>You do not have permissions to access this area. To gain permission, please contact the site administrator. Click <strong><a href='/'>HERE</a></strong> to go back.
    <p>
@endif
