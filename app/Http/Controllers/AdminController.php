<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'email'=>''
        ]);
        $query = ($request->input('email'));
        $isadmin = DB::table('admins')->select('user_id')->get();
        $results = DB::table('users')->where('email', 'like', '%'.$query.'%')->get();
        $isadminarray=[];
        foreach($isadmin as $x=>$y){
            array_push($isadminarray, ((array)$isadmin[$x])['user_id']);
        }
        return view('admin.index', ['results' => $results, 'admin'=> $isadminarray]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($username)
    {
        $userid = DB::table('users')->where('username', $username)->get('id');
        $useridarray= ((array)$userid[0]);
        DB::table('admins')->insert(
            ['user_id' => $useridarray['id']],
        );

        return redirect('/admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        DB::table('users')->where('username', $username)->delete();
        return redirect('/admin');
    }
}
