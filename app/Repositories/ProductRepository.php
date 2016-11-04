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
	function all() {
		return Product::with(['category' => function($query) {
				$query->select('id', 'category_name');
			},
			'user' => function($query) {
				$query->select('id', 'name', 'email');
			}
		])->get();
	}

	/**
	*	Get a product by product ID
	*
	*	@param int $id
	*	@return App\Product
	*/
	function forId($id) {
		return Product::with(
			['category' => function($query) {
				$query->select('id', 'category_name');
		}])->findOrFail($id);
	}

	/**
	*	Get products for a given user
	*
	*	@param App\User $user
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forUser(User $user) {
		return $user->products()
		->with(
			['category' => function($query) {
				$query->select('id', 'category_name');
		}])
		->orderBy('created_at', 'asc')
		->get();
	}

	/**
	*	Get products for a given user
	*
	*	@param int $id
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forUserId($id) {
		return User::find($id)
		->products()
		->with(
			['category' => function($query) {
				$query->select('id', 'category_name');
		}])
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
		->with(
			['category' => function($query) {
				$query->select('id', 'category_name');
		}])
		->where('id', $id)
		->first();
	}

	/**
	*	Get products for a given user ID and product ID
	*
	*	@param int $userId
	*   @param int $id
	*   @return App\Product
	*/
	function forUserIdAndId($userId, $id) {
		return User::find($userId)
		->products()
		->with(
			['category' => function($query) {
				$query->select('id', 'category_name');
		}])
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
		->with(
			['category' => function($query) {
				$query->select('id', 'category_name');
		}])
		->orderBy('created_at', 'asc')
		->get();
	}

	/**
	*	Get products for a given category ID
	*
	*	@param int $id
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forCategoryId($id) {
		return Category::find($id)
		->products()
		->with(
			['category' => function($query) {
				$query->select('id', 'category_name');
		}])
		->orderBy('created_at', 'asc')
		->get();
	}

	/**
	*	Get products for a given category slug
	*
	*	@param String $slug
	*   @return \Illuminate\Database\Eloquent\Collection
	*/
	function forCategorySlug($slug) {
		return Category::findBySlug($slug)
		->products()
		// ->with(
		// 	['category' => function($query) {
		// 		$query->select('id', 'category_name');
		// }])
		->orderBy('created_at', 'asc')
		->get();
	}

	/**
	*	Store a new product
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $userId
	*	@return bool
	*/
	function createProduct(Request $request, $userId) {
		$product = new Product;

		$product->product_name = $request->input('product_name');
        $product->product_description = $request->input('product_description');
        $product->category_id = $request->input('product_category');
        $product->user_id = $userId;

        return $product->save();
	}

	/**
	*	Update the product
	*
	*	@param \Illuminate\Http\Request $request
	*	@param App\Product $product
	*	@return bool
	*/
	function update(Request $request, $product){
		$product->product_name = $request->input('product_name');
        $product->product_description = $request->input('product_description');
        $product->category_id = $request->input('product_category');
        $product->save();

        return $product->save();
	}

	/**
	*	Update a product by product ID
	*
	*	@param \Illuminate\Http\Request $request
	*	@param int $id
	*	@param int $userId
	*	@return App\Product
	*/
	function updateById(Request $request, $id, $userId) {
		$product = $this->forUserIdAndId($userId, $id);

		$this->update($request, $product);
        
        return $product;
	}

	/**
	*	Delete a product by product ID
	*
	*	@param int $id
	*	@return bool
	*/
	function deleteById($id) {
		$product = $this->forId($id);
		return $product->delete();
	}







}