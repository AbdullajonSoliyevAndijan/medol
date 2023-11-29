<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    public function offerView(){
        $offers = Offer::get();
        return view('backend.offer.offer_view', compact('offers'));
    }

    public function offerAdd(){
        return view('backend.offer.offer_add');
    }

    public function offerStore(Request $request){
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
        $upload_path = 'upload/offer/image/';    //Creating Sub directory in Public folder to put image
        $save_url_image = $upload_path . $image_full_name;
        $success = $image->move($upload_path, $image_full_name);

        Offer::create([
            'image' => $save_url_image,
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message' => 'Предложение успешно добавлена!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.offer')->with($notification);
    }

    public function offerEdit($id){
        $offer = Offer::where('id', $id)->first();
        return view('backend.offer.offer_edit', compact('offer'));
    }

    public function offerUpdate(Request $request, $id){
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
        $offer = Offer::where('id', $id)->first();
        $image = $request->file('image');
        if ($image){
            unlink($offer->image);
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'upload/offer/image/';    //Creating Sub directory in Public folder to put image
            $save_url_image = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        }else{
            $save_url_image = $offer->image;
        }

        $offer->update([
            'image' => $save_url_image,
            'title' => $request->title,
            'content' => $request->content,
        ]);


        $notification = array(
            'message' => 'Предложение успешно изменена!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.offer')->with($notification);
    }

    public function offerDelete($id){
        $offer = Offer::where('id', $id)->first();
        unlink($offer->image);
        $offer->delete();

        $notification = array(
            'message' => 'Предложение успешно удалено!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
