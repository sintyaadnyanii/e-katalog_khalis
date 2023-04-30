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
            'categories'=> Category::latest()->filter(request(['search']))->paginate(15)->withQueryString(),
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

    public function detailCategory(Category $category){
        $data=[
            'title'=>'Category Detail | E-Katalog Khalis Bali Bamboo',
            'category'=>$category,
        ];
        return view('admin.categories.category-detail',$data);
    }

    public function storeCategory(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|max:50',
            'slug'=>'required',
            'description'=>'required|string',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','There must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $created_category=Category::create([
            'name'=>$validated['name'],
            'slug'=>$validated['slug'],
            'description'=>$validated['description'],
        ]);
        if($created_category){
            return redirect()->route('manage_category.all')->with('success','New Category Created Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function patchCategory(Request $request, Category $category){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|max:50',
            'slug'=>'required',
            'description'=>'required|string',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('error','There must be something wrong with the input!');
        }
        $validated=$validator->validated();
        $updated_category=$category->update([
            'name'=>$validated['name'],
            'slug'=>$validated['slug'],
            'description'=>$validated['description'],
        ]);
        if($updated_category){
            return redirect()->route('manage_category.all')->with('success','Category "'.$category->name.'" Updated Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function deleteCategory(Category $category){
        $category->products()->delete();
        if($category->delete()){
            return redirect()->route('manage_category.all')->with('success','Category "'.$category->name.'" Deleted Successfully');
        }
        return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function getSlug(Request $request){
        return response()->json(['data'=>Category::sluged($request->name,$request->id)]);
    }
}