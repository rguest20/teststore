<?php if (DB::table('admins')->where('id', 1)->doesntExist()) {
    DB::table('admins')->updateOrInsert(
        [],
        ['id' => 1, 'user_id' => 1, 'created_at'=> time(), 'updated_at' => time()]
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
                <h3 class="text-lg font-medium text-gray-900">Create a New Administrator</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Search using the box to the right and click submit to upgrade a person to admin.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form name="createadmin" method="post" target="admin.search">
              @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="current_password">Email Address</label>
                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="current_password" type="password" wire:model.defer="state.current_password" autocomplete="current-password">
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="submitaddadmin">Search</label>
                                <input class="inline-flex items-center justify-center p-2 rounded-md bg-blue-300 text-gray-800 hover:text-gray-800 hover:bg-red-500 focus:outline-none focus:bg-blue-900 focus:text-gray-500 transition duration-150 ease-in-out" id="submitaddadmin" type="submit">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @else
        <p>You do not have permissions to access this area. To gain permission, please contact the site administrator. Click <strong><a href='/'>HERE</a></strong> to go back.
        <p>
            @endif
