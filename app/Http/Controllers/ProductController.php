<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function allProduct(){
        $data=[
            'title'=>'All Products| E-Katalog Khalis Bali Bamboo',
            'products'=>Product::latest()->filter(request(['search','category']))->paginate(15)->withQueryString(),
            'categories'=>Category::latest()->get()
        ];
        return view('admin.products.product-all',$data);
    }

    public function createProduct(){
        $data=[
            'title'=>'Add New Product | E-Katalog Khalis Bali Bamboo',
            'categories'=>Category::latest()->get()
        ];
        return view('admin.products.product-create',$data);
    }

    public function updateProduct(Product $product){
        $data=[
            'title'=>'Update Product | E-Katalog Khalis Bali Bamboo',
            'categories'=>Category::latest()->get(),
            'product'=>$product
        ];
        return view('admin.products.product-update',$data);
    }

    public function detailProduct(Product $product){
        $data=[
            'title'=>'Product Detail | E-Katalog Khalis Bali Bamboo',
            'product'=>$product
        ];
        return view('admin.products.product-detail',$data);
    }

    public function storeProduct(Request $request){
        $validator=Validator::make($request->all(),[
            'product_code'=>'required|string|max:8|unique:products,product_code',
            'category_id'=>'required|integer',
            'name'=>'required|string|max:50',
            'dimensions'=>'required|string',
            'materials'=>'required|string',
            'color'=>'required|string',
            'price'=>'required|numeric',
            'description'=>'nullable|string',
            'link_shopee'=>'nullable|string',
            'images.*'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error','There must be something wrong with the input!');
    }
    $validated=$validator->validated();
    $created_product=Product::create([
        'product_code'=>$validated['product_code'],
        'category_id'=>$validated['category_id'],
        'name'=>$validated['name'],
        'dimensions'=>$validated['dimensions'],
        'materials'=>$validated['materials'],
        'color'=>$validated['color'],
        'price'=>$validated['price'],
        'description'=>$validated['description'],
        'link_shopee'=>$validated['link_shopee'],
    ]);
    if($created_product){
        return redirect()->route('manage_product.all')->with('success','New Product Created Successfully');
    }
    return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function patchProduct(Request $request,Product $product){
    if($request->product_code!=$product->product_code){
        if(Product::where('product_code',$product->product_code)->count()){
            return redirect()->back()->withInput()->with('error', 'This product has been registered, please input another product');
        }else{
            $code_validator = Validator::make($request->all(), [
                'product_code' => 'required|string|unique:products,product_code',
            ]);

            if ($code_validator->fails()) {
                return redirect()->back()->withErrors($code_validator)->withInput()->with('error', 'Error Occured, Please Try Again!');
            }

            $validated_code = $code_validator->validate();
            $product->update(['product_code' => $validated_code['product_code']]);
        }
    }
    $validator=Validator::make($request->all(),[
        'category_id'=>'required|integer',
        'name'=>'required|string|max:50',
        'dimensions'=>'required|string',
        'materials'=>'required|string',
        'color'=>'required|string',
        'price'=>'required|numeric',
        'description'=>'nullable|string',
        'link_shopee'=>'nullable|string',
        'images.*'=>'required|image|mimes:jpeg,jpg,png|max:2048'
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput()->with('error','There must be something wrong with the input!');
    }
    $validated=$validator->validated();
    $product->touch();
    $updated_product=$product->update([
        'category_id'=>$validated['category_id'],
        'name'=>$validated['name'],
        'dimensions'=>$validated['dimensions'],
        'materials'=>$validated['materials'],
        'color'=>$validated['color'],
        'price'=>$validated['price'],
        'description'=>$validated['description'],
        'link_shopee'=>$validated['link_shopee'],
    ]);
    if($updated_product){
        return redirect()->route('manage_product.all')->with('success','Product "'.$product->name.'" Updated Successfully');
    }
    return redirect()->back()->with('error','Error Occured, Please Try Again!');
    }

    public function deleteProduct(Product $product){
        if ($product->delete()) {
            return redirect()->route('manage_product.all')->with('success', 'Product "'.$product->name.'" Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Error Occured, Please Try Again!');
    }

    public function getProductCode(Request $request){
        return response()->json(['data'=>Product::generatedCode($request->category_id)]);
    }
}