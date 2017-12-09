<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validation\PostValidator;
use App\SubCategory;
use App\Category;

class CategoryController extends Controller
{
	public function addCategory()
	{	
		$data = Category::all();
		return view('category.addCategory',compact('data'));
	}

	public function storeCategory(Request $request)
	{
		$category = new Category();
		$category->category_name = $request['category_name'];
		$category->image_name = $request['category_image'];
		// dd($category);
		$category->save();

		return redirect()->back();
			
	}

   public function addSubCategory(Request $request) 
   {
      $subCategory = new SubCategory();
      $subCategory->parent_category = $request['parentCategory'];
      $subCategory->sub_category = $request['subCategory'];
      // dd($subCategory);
      $subCategory->save();

      return redirect()->back();
   }
}
