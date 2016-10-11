<?php

namespace App\Contracts;

use App\Category;
use Illuminate\Http\Request;

interface CategoryRepositoryInterface {

	/**
	*   Get all categories
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function getCategory();

	/**
	*	Get a category by category ID
	*
	*	@param int $id
	*	@return App\Category
	*/
	function forId($id);

	/**
	*	Get a category by category slug
	*
	*	@param String $slug
	*	@return App\Category
	*/
	function forSlug($slug);

	/**
	*	Store a new category
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function createCategory(Request $request);

	/**
	*	Update the category
	*
	*	@param \Illuminate\Http\Request $request
	*	@param App\Category $category
	*	@return bool
	*/
	function update(Request $request, $category);

	/**
	*	Update a category by category ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return bool
	*/
	function updateById(Request $request, $id);

	/**
	*	Update a category by category slug
	*
	*	@param \Illuminate\Http\Request $request
	*	@param String $slug
	*	@return bool
	*/
	function updateBySlug(Request $request, $slug);

	/**
	*	Delete a category by category ID
	*
	*	@param int $id
	*	@return bool
	*/
	function deleteByID($id);

	/**
	*	Delete a category by category slug
	*
	*	@param String $slug
	*	@return bool
	*/
	function deleteBySlug($slug);






}