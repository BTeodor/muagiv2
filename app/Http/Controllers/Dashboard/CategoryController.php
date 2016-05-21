<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App;

class CategoryController extends Controller
{
    //
    public function index(){
    	$categories = App\Category::all();

    	if (count($categories) == 0) {
    		return "No category";
    	}

    	return view('dashboard.category.category', compact('categories'));
    }

    public function create(){
    	return view('dashboard.category.add');
    }

    public function store(CreateCategoryRequest $request){
    	$data = $request->only('name_vi', 'name_en', 'image', 'description');

    	App\Category::create($data);

    	return redirect()->route('category.list')->withSuccess('Successfully created new category');
    }

    public function edit($id){
    	$category = App\Category::find($id);
    	if ($category == NULL) {
    		return "Category not exist";
    	}

    	return view('dashboard.category.edit', compact('category'));
    }

    public function delete($id){
    	$category = App\Category::find($id);
    	if ($category == NULL) {
    		return "Category not exist";
    	}
    	$category->delete();

    	return redirect()->route('category.list')->withSuccess('Successfully deleted');
    }

    public function update(UpdateCategoryRequest $request){
    	$id = $request->id;
    	$data = $request->only('name_vi', 'name_en', 'image', 'description');
    	$category = App\Category::find($id);
    	if ($category == NULL) {
    		return "Category not exist";
    	}
    	$category->update($data);
    	return redirect()->back()->withSuccess('Successfully updated');
    }
}
