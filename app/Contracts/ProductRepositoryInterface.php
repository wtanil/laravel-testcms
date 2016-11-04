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
	function all();

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
	*	Get products for a given user ID
	*
	*	@param int $id
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forUserId($id);

	/**
	*	Get products for a given user and product ID
	*
	*	@param App\User $user
	*   @param int $id
	*   @return App\Product
	*/
	function forUserAndId(User $user, $id);

	/**
	*	Get products for a given user ID and product ID
	*
	*	@param int $userId
	*   @param int $id
	*   @return App\Product
	*/
	function forUserIdAndId($userId, $id);

	/**
	*	Get products for a given category
	*
	*	@param Category $category
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forCategory(Category $category);

	/**
	*	Get products for a given category ID
	*
	*	@param int $id
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forCategoryId($id);

	/**
	*	Get products for a given category slug
	*
	*	@param String $slug
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forCategorySlug($slug);

	/**
	*	Store a new product
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $userId
	*	@return bool
	*/
	function createProduct(Request $request, $userId);

	/**
	*	Update the product
	*
	*	@param \Illuminate\Http\Request $request
	*	@param App\Product $product
	*	@return bool
	*/
	function update(Request $request, $product);

	/**
	*	Update a product by product ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@param int $userId
	*	@return App\Product
	*/
	function updateById(Request $request, $id, $userId);

	/**
	*	Delete a product by product ID
	*
	*	@param int $id
	*	@return bool
	*/
	function deleteById($id);

}
