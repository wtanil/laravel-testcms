<?php

namespace App\Contracts;

use App\User;
use App\Category;
use Illuminate\Http\Request;

interface ProductRepositoryInterface {

	/**
	*   Get all products
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function getProduct();

	/**
	*	Get a product by product ID
	*
	*	@param int $id
	*	@return App\Product
	*/
	function forId($id);

	/**
	*	Get products for a given user
	*
	*	@param App\User $user
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forUser(User $user);

	/**
	*	Get products for a given user and product id
	*
	*	@param App\User $user
	*   @param int $id
	*   @return App\Product
	*/
	function forUserAndId(User $user, $id);

	/**
	*	Get products for a given category
	*
	*	@param Category $category
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forCategory(Category $category);

	/**
	*	Store a new product
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function createProduct(Request $request);

	/**
	*	Update a product by product ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return bool
	*/
	function updateById(Request $request, $id);

	/**
	*	Delete a product by product ID
	*
	*	@param App\User $user
	*	@param int $id
	*	@return bool
	*/
	function deleteById(User $user, $id);

}
