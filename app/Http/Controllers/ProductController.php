<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('product.index', ['category' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $name = ($request->input('name'));
        $description = ($request->input('description'));
        $price = ($request->input('price'));
        $units = ($request->input('units'));
        $cat_id = ($request->input('cat_id'));
        $path = request('image')->store('uploads', 'public');
        DB::table('products')->insert([
            'product_name'=> $name,
            'product_description' => $description,
            'price'=> $price,
            'image' => $path,
            'units' => $units,
            'category_id'=> $cat_id,
        ]);
        return redirect('category/'.$id.'/products/index');
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
    public function edit($id, $product)
    {
        return view('product.edit', ['category'=> $id, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $product)
    {
        $product_name = ($request->input('name'));
        $product_description = ($request->input('description'));
        $price = ($request->input('price'));
        $units = ($request->input('units'));
        if ($request->file('image') != null) {
            $path = request('image')->store('uploads', 'public');
        }else{
            $path = (DB::table('products')->where('id', $product)->get())[0]->image;
        }
        DB::table('products')->where('id', $product)->update([
            'product_name'=> $product_name,
            'product_description' => $product_description,
            'price'=> $price,
            'image' => $path,
            'units' => $units,
        ]);
        return redirect('category/'.$id.'/products/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $product)
    {
        DB::table('products')->where('id',$product)->delete();
        return redirect('category/'.$id.'/products/index');
    }
}
