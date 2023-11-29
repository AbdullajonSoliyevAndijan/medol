<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function productView(){
        $products = Product::get();
        return view('backend.product.product_view', compact('products'));
    }

    public function productAdd(){
        return view('backend.product.product_add');
    }

    public function productStore(Request $request){
        $request->validate(
            [
                'image' => 'required',
                'name' => 'required',
            ],
            [
                'image.required' => 'Загрузить изображение',
                'name.required' => 'Введите название продукта',
            ]
        );

        $image = $request->file('image');

        $image_name = Str::random(20);
        $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'upload/product/image/';    //Creating Sub directory in Public folder to put image
        $save_url_image = $upload_path . $image_full_name;
        $success = $image->move($upload_path, $image_full_name);

        Product::create([
            'image' => $save_url_image,
            'name' => $request->name,
            'content' => $request->content,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message' => 'Продукт успешно добавлена!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    }

    public function productEdit($id){
        $product = Product::where('id', $id)->first();
        return view('backend.product.product_edit', compact('product'));
    }

    public function productUpdate(Request $request, $id){
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Введите название продукта',
            ]
        );
        $product = Product::where('id', $id)->first();
        $image = $request->file('image');
        if ($image){
            unlink($product->image);
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'upload/product/image/';    //Creating Sub directory in Public folder to put image
            $save_url_image = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        }else{
            $save_url_image = $product->image;
        }

        $product->update([
            'image' => $save_url_image,
            'name' => $request->name,
            'content' => $request->content,
        ]);


        $notification = array(
            'message' => 'Продукт успешно изменена!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function productDelete($id){
        $product = Product::where('id', $id)->first();
        unlink($product->image);
        $product->delete();

        $notification = array(
            'message' => 'Продукт успешно удалено!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
