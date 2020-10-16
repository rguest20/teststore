<?php
$tableEmpty= DB::table('admins')->count();
if ($tableEmpty == 0) {
    DB::table('admins')->insert(
        ['user_id' => \Illuminate\Support\Facades\Auth::id()]
    );
    echo 'You have been set as principal administrator as there are no other administrators currently';
}
$isadmin = DB::table('admins')->where('user_id', "=", Auth::id())->get();
$catdetails= DB::table('categories')->where('category_name', '=', $category)->get();
?>
@if ($isadmin != "[]")
    <h1 class="text-lg font-bold">Stock Control | Categories Editor</h1>
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
                    <h3 class="text-lg font-medium text-gray-900">Update Category Information</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Update the information visible for the users then click submit.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form name="categoryupdate" method="POST" action="update">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <!-- Category Name -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <label class="block font-medium text-sm text-gray-700" for="category_name">Name</label>
                                        <input id="category_name" type="text" name = "name" class="form-input rounded-md shadow-sm mt-1 block w-full" autocomplete="category_name" value = "{{ $catdetails[0]-> category_name }}" />
                                    </div>
                                    <!-- Username -->
                                    <div class="col-span-6 sm:col-span-4">
                                        <label class="block font-medium text-sm text-gray-700" for="category_description">Description</label>
                                        <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" name="description" autocomplete=off>{{ $catdetails[0]->category_description }}</textarea>
                                    </div>
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
