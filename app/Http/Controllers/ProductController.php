<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Product;
use App\Category;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;

class ProductController extends Controller {
    /**
     * The product repository instance.
     *
     * @var ProductRepositoryInterface
     */
    protected $product;

    /**
     * The category repository instance.
     *
     * @var CategoryRepositoryInterface
     */
    protected $category;

    /**
     * Create a new controller instance.
     *
     * @param  ProductRepositoryInterface $product
     * @param  CategoryRepositoryInterface $category
     * @return void
     */
    public function __construct(ProductRepositoryInterface $product, CategoryRepositoryInterface $category) {

        $this->middleware('auth');
        $this->product = $product;
        $this->category = $category;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $tmpProducts = $this->product->forUser($request->user());

        return view('product.index', [
            'products' => $tmpProducts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $tmpCategory = $this->category->getCategory();

        return view('product.create', ['categories' => $tmpCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

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

        $this->product->createProduct($request);

        return redirect('/product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {

        $tmpProduct = $this->product->forUserAndId($request->user(), $id);

        return view('product.show', ['product' => $tmpProduct]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {

        $tmpProduct = $this->product->forUserAndId($request->user(), $id);
        $tmpCategory = $this->category->getCategory();

        return view('product.edit', ['product' => $tmpProduct,
            'categories' =>$tmpCategory
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
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

        $tmpProduct = $this->product->updateById($request, $id);

        return redirect('/product/' . $tmpProduct->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        
        $this->product->deleteById($request->user(), $id);

        return redirect('/product');
    }
}
