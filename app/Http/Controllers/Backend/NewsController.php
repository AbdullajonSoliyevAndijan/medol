<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    public function newsView(){
        $news = News::get();
        return view('backend.news.news_view', compact('news'));
    }

    public function newsAdd(){
        return view('backend.news.news_add');
    }

    public function newsStore(Request $request){
        $request->validate(
            [
                'image' => 'required',
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'image.required' => 'Загрузить изображение',
                'title.required' => 'Введите название',
                'content.required' => 'Введите текст'
            ]
        );

        $image = $request->file('image');

        $image_name = Str::random(20);
        $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'upload/news/image/';    //Creating Sub directory in Public folder to put image
        $save_url_image = $upload_path . $image_full_name;
        $success = $image->move($upload_path, $image_full_name);

        News::create([
            'image' => $save_url_image,
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message' => 'Новости успешно добавлена!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.news')->with($notification);
    }

    public function newsEdit($id){
        $news = News::where('id', $id)->first();
        return view('backend.news.news_edit', compact('news'));
    }

    public function newsUpdate(Request $request, $id){
        $request->validate(
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Введите название',
                'content.required' => 'Введите текст'
            ]
        );
        $news = News::where('id', $id)->first();
        $image = $request->file('image');
        if ($image){
            unlink($news->image);
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'upload/news/image/';    //Creating Sub directory in Public folder to put image
            $save_url_image = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        }else{
            $save_url_image = $news->image;
        }

        $news->update([
            'image' => $save_url_image,
            'title' => $request->title,
            'content' => $request->content,
        ]);


        $notification = array(
            'message' => 'Новости успешно изменена!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.news')->with($notification);
    }

    public function newsDelete($id){
        $news = News::where('id', $id)->first();
        unlink($news->image);
        $news->delete();

        $notification = array(
            'message' => 'Новости успешно удалено!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
