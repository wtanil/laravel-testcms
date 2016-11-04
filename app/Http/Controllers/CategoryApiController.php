<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryApiController extends Controller {

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
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $category) {

        $this->category = $category;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tmpCategories = $this->category->all();

        return response()->json($tmpCategories, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request) {
        $this->category->createCategory($request);

        return response()->json(['message' => 'Create success'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return response()->json($this->category->forId($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id) {
        $tmpProduct = $this->category->updateById($request, $id);

        return response()->json(['message' => 'Update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->category->deleteById($id);
        return response()->json(['message' => 'Delete success'], 200);
    }
}
