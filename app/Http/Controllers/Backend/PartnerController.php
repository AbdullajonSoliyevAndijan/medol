<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnerController extends Controller
{

    public function partnerView(){
        $partners = Partner::get();
        return view('backend.partner.partner_view', compact('partners'));
    }

    public function partnerAdd(){
        return view('backend.partner.partner_add');
    }

    public function partnerStore(Request $request){
        $request->validate(
            [
                'image' => 'required',
                'name' => 'required',
            ],
            [
                'image.required' => 'Загрузить логотип',
                'name.required' => 'Введите имя партнера',
            ]
        );

        $image = $request->file('image');

        $image_name = Str::random(20);
        $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'upload/partner/image/';    //Creating Sub directory in Public folder to put image
        $save_url_image = $upload_path . $image_full_name;
        $success = $image->move($upload_path, $image_full_name);

        Partner::create([
            'image' => $save_url_image,
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message' => 'Партнер успешно добавлена!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.partner')->with($notification);
    }

    public function partnerEdit($id){
        $partner = Partner::where('id', $id)->first();
        return view('backend.partner.partner_edit', compact('partner'));
    }

    public function partnerUpdate(Request $request, $id){
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Введите имя партнера',
            ]
        );
        $partner = Partner::where('id', $id)->first();
        $image = $request->file('image');
        if ($image){
            unlink($partner->image);
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'upload/partner/image/';    //Creating Sub directory in Public folder to put image
            $save_url_image = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        }else{
            $save_url_image = $partner->image;
        }

        $partner->update([
            'image' => $save_url_image,
            'name' => $request->name,
        ]);


        $notification = array(
            'message' => 'Партнер успешно изменена!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.partner')->with($notification);
    }

    public function partnerDelete($id){
        $partner = Partner::where('id', $id)->first();
        unlink($partner->image);
        $partner->delete();

        $notification = array(
            'message' => 'Партнер успешно удалено!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
