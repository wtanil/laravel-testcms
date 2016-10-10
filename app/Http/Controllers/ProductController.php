<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Validator;
use App\Product;
use App\Category;

class ProductController extends Controller
{

    public function __construct() {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $products = Product::where('user_id', Auth::user()->id)->get();

        // $tasks = $request->user()->tasks()->get();
        $products = $request->user()->products()->get();

        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:255',
            'product_description' => 'max:1000',
            'product_category' => 'required'
            ]);

        if ($validator->fails()) {
            return redirect('/product/create')
            ->withInput()
            ->withErrors($validator);
        }

        $product = new Product;

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->product_category;
        // $product->user_id = Auth::user()->id;
        $product->user_id = $request->user()->id;
        $product->save();

        return redirect('/product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where([
                ['id', $id],
                ['user_id', Auth::user()->id]
            ])->first();

        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where([
                ['id', $id],
                ['user_id', Auth::user()->id]
            ])->first();

        $categories = Category::all();
        // return view('product.create', ['categories' => $categories]);

        return view('product.edit', ['product' => $product,
            'categories' =>$categories
            ]);
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
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:255',
            'product_description' => 'max:1000',
            'product_category' => 'required'
            ]);

        if ($validator->fails()) {
            return redirect('/product/' . $id . '/edit')
            ->withInput()
            ->withErrors($validator);
        }

        $product = Product::where([
                ['id', $id],
                ['user_id', Auth::user()->id]
            ])->first();

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->product_category;
        $product->save();

        return redirect('/product/' . $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where([
                ['id', $id],
                ['user_id', Auth::user()->id]
            ])->first();
        $product->delete();
        

        return redirect('/product');
    }
}
