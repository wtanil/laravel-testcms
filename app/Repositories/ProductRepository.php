<?php

namespace App\Repositories;

use App\Product;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

	/**
	*   Get all products
	*
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function getProduct() {
		return Product::all();
	}

	/**
	*	Get a product by product ID
	*
	*	@param int $id
	*	@return App\Product
	*/
	function forId($id) {
		return Product::find($id);
	}

	/**
	*	Get products for a given user
	*
	*	@param App\User $user
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forUser(User $user) {
		return $user->products()
		->orderBy('created_at', 'asc')
		->get();
	}

	/**
	*	Get products for a given user and product id
	*
	*	@param App\User $user
	*   @param int $id
	*   @return App\Product
	*/
	function forUserAndId(User $user, $id) {
		return $user->products()
		->where('id', $id)
		->first();
	}

	/**
	*	Get products for a given category
	*
	*	@param Category $category
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forCategory(Category $category) {
		return $category->products()
		->orderBy('created_at', 'asc')
		->get();
	}

	/**
	*	Store a new product
	*
	*	@param \Illuminate\Http\Request $request
	*	@return bool
	*/
	function createProduct(Request $request) {
		$product = new Product;

		$product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->product_category;
        $product->user_id = $request->user()->id;

        return $product->save();
	}

	/**
	*	Update a product by product ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return App\Product
	*/
	function updateById(Request $request, $id) {
		$product = $this->forUserAndId($request->user(), $id);

		$product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->category_id = $request->product_category;
        $product->user_id = $request->user()->id;
        $product->save();
        
        return $product;
	}

	/**
	*	Delete a product by product ID
	*
	*	@param App\User $user
	*	@param int $id
	*	@return bool
	*/
	function deleteById(User $user, $id) {
		$product = $this->forUserAndId($request->user(), $id);
		return $product->delete();
	}







}