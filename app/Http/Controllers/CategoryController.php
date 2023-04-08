<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function allCategory(){
        $data=[
            'title'=>'Categories | E-Katalog Khalis Bali Bamboo',
            'categories'=> Category::latest()->get(),
        ];
        return view('admin.categories.category-all',$data);
    }

    public function createCategory(){
        $data=[
            'title'=>'Add New Category | E-Katalog Khalis Bali Bamboo'
        ];
        return view('admin.categories.category-create',$data);
    }

    public function updateCategory(Category $category){
        $data=[
            'title'=>'Update Category | E-Katalog Khalis Bali Bamboo',
            'category'=>$category,
        ];
        return view('admin.categories.category-update',$data);
    }

    public function storeCategory(Request $request){
        $validator=Validator::make($request->all(),[
            'category_name'=>'required|max:50',
            'category_description'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','Oops, there must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $created_category=Category::create([
            'name'=>$validated['category_name'],
            'description'=>$validated['category_description'],
        ]);
        if($created_category){
            return redirect()->route('manage_category.all')->with('success','New Category Created Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function patchCategory(Request $request, Category $category){
        $validator=Validator::make($request->all(),[
            'category_name'=>'required|max:50',
            'category_description'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','Oops, there must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $updated_category=$category->update([
            'name'=>$validated['category_name'],
            'description'=>$validated['category_description'],
        ]);
        if($updated_category){
            return redirect()->route('manage_category.all')->with('success','Category Updated Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function deleteCategory(Category $category){
        if($category->delete()){
            return redirect()->route('manage_category.all')->with('success',$category->name.'Category Deleted Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }
}