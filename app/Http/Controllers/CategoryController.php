<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Category;
use App\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller {

    /**
     * The category repository instance.
     *
     * @var CategoryRepositoryInterface
     */
    protected $category;

    /**
     * Create a new controller instance.
     *
     * @param  CategoryRepositoryInterface $category
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $category) {

        $this->middleware('auth');
        $this->category = $category;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tmpCategory = $this->category->getCategory();

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:255',
            'category_description' => 'max:1000'
            ]);

        if ($validator->fails()) {
            return redirect('/category/create')
            ->withInput()
            ->withErrors($validator);
        }

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

        return view('category.show', ['category' => $tmpCategory]);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:255',
            'category_description' => 'max:1000'
            ]);

        if ($validator->fails()) {
            return redirect('/category/' . $slug . '/edit')
            ->withInput()
            ->withErrors($validator);
        }

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
