<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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

        $tmpCategory = $this->category->all();

        return view('product.create', ['categories' => $tmpCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request) {

        $this->product->createProduct($request, $request->user()->id);

        return redirect('/product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {

        // $tmpProduct = $this->product->forUserAndId($request->user(), $id);
        $tmpProduct = $this->product->forId($id);

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
        $tmpCategory = $this->category->all();

        return view('product.edit', ['product' => $tmpProduct,
            'categories' =>$tmpCategory
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id) {

        $tmpProduct = $this->product->updateById($request, $id, $request->user()->id);

        return redirect('/product/' . $tmpProduct->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        $this->product->deleteById($id);

        return redirect('/product');
    }
}
