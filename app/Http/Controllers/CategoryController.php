<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Category;

class CategoryController extends Controller
{

    public function __construct() {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $category = Category::all();

        return view('category.index', ['categories' => $category]);

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

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;

        $category->save();

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
        $category = Category::findBySlugOrFail($slug);

        return view('category.show', ['category' => $category]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $category = Category::findBySlugOrFail($slug);

        return view('category.edit', ['category' => $category]);
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

        $category = Category::findBySlugOrFail($slug);
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;

        $category->save();

        return redirect('/category/' . $category->category_name_slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $category = Category::findBySlugOrFail($slug);
        $category->delete();
        

        return redirect('/category');
    }
}
