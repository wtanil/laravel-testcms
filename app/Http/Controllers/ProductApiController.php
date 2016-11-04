<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Exception;
use App\Http\Requests;
use App\Product;
use App\Contracts\ProductRepositoryInterface;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductApiController extends Controller
{

    /**
     * The product repository instance.
     *
     * @var ProductRepositoryInterface
     */
    protected $product;

    /**
     * Create a new controller instance.
     *
     * @param  ProductRepositoryInterface $product
     * @return void
     */
    public function __construct(ProductRepositoryInterface $product) {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tmpProducts = $this->product->all();

        return response()->json($tmpProducts, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request) {
        $this->product->createProduct($request, $request->user_id);

        return response()->json(['message' => 'Create success'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return response()->json($this->product->forId($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id) {
        $tmpProduct = $this->product->updateById($request, $id, $request->user_id);

        return response()->json(['message' => 'Update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->product->deleteById($id);
        return response()->json(['message' => 'Delete success'], 200);
    }
}
