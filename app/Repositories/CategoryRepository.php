<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Http\Request;
use App\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface {

	/**
	*   Get all categories
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function all() {
		return Category::all();
	}

	/**
	*	Get a category by category ID
	*
	*	@param int $id
	*	@return App\Category
	*/
	function forId($id) {
		return Category::findOrFail($id);
	}

	/**
	*	Get a category by category slug
	*
	*	@param String $slug
	*	@return App\Category
	*/
	function forSlug($slug) {
		return Category::findBySlugOrFail($slug);
	}

	/**
	*	Store a new category
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function createCategory(Request $request) {
		$category = new Category;

        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');

        return $category->save();
	}

	/**
	*	Update the category
	*
	*	@param \Illuminate\Http\Request $request
	*	@param App\Category $category
	*	@return bool
	*/
	function update(Request $request, $category){
		$category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');

        return $category->save();
	}

	/**
	*	Update a category by category ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return App\Category
	*/
	function updateById(Request $request, $id) {
		$category = $this->forId($id);
		$this->update($request, $category);

		return $category;

	}

	/**
	*	Update a category by category slug
	*
	*	@param \Illuminate\Http\Request $request
	*	@param String $slug
	*	@return App\Category
	*/
	function updateBySlug(Request $request, $slug) {
		$category = $this->forSlug($slug);
		$this->update($request, $category);

		return $category;
	}

	/**
	*	Delete a category by category ID
	*
	*	@param int $id
	*	@return bool
	*/
	function deleteByID($id) {
		$category = $this->forId($id);
        return $category->delete();
	}

	/**
	*	Delete a category by category slug
	*
	*	@param String $slug
	*	@return bool
	*/
	function deleteBySlug($slug) {
		$category = $this->forSlug($slug);
        return $category->delete();
	}

}