<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Category;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;

class CategoryController extends Controller {

    /**
     * The category repository instance.
     *
     * @var CategoryRepositoryInterface
     */
    protected $category;

    /**
     * The product repository instance.
     *
     * @var ProductRepositoryInterface
     */
    protected $product;

    /**
     * Create a new controller instance.
     *
     * @param  CategoryRepositoryInterface $category
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $category, ProductRepositoryInterface $product) {

        $this->middleware('auth');
        $this->category = $category;
        $this->product = $product;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tmpCategory = $this->category->all();

        return view('category.index', ['categories' => $tmpCategory]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {

        $this->category->createCategory($request);

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tmpCategory = $this->category->forSlug($slug);
        $tmpProduct = $this->product->forCategorySlug($slug);

        return view('category.show', ['category' => $tmpCategory, 'products' => $tmpProduct]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $tmpCategory = $this->category->forSlug($slug);

        return view('category.edit', ['category' => $tmpCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {

        $tmpCategory = $this->category->updateBySlug($request, $slug);

        return redirect('/category/' . $tmpCategory->category_name_slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $this->category->deleteBySlug($slug);
        return redirect('/category');
    }
}
