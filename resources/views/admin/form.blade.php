<?php
$tableEmpty= DB::table('admins')->count();
if ($tableEmpty == 0) {
    DB::table('admins')->insert(
        ['user_id' => \Illuminate\Support\Facades\Auth::id()]
    );
    echo 'You have been set as principal administrator as there are no other administrators currently';
}
$isadmin = DB::table('admins')->where('user_id', "=", Auth::id())->get();
?>
@if ($isadmin != "[]")
<h1 class="text-lg font-bold">You are an Admin, welcome to the Admin panel </h1>
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
                <h3 class="text-lg font-medium text-gray-900">Create a New Administrator/Delete Users</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Search using the box to the right and click submit to upgrade a person to admin. Option to delete users.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form name="queryadmin" method="POST" action="admin/index/">
              @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="email">Email Address</label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" name="email" id="email" type="text" autocomplete="email">
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
                <h3 class="text-lg font-medium text-gray-900">Stock Control</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Add/Remove categories, Add/Remove products, Edit product details including stock.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <button class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" type="button">Enter Stock Control Dashboard</button>
        </div>
    </div>
</div>
        @else
        <p>You do not have permissions to access this area. To gain permission, please contact the site administrator. Click <strong><a href='/'>HERE</a></strong> to go back.
        <p>
            @endif
