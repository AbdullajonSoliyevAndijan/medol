<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function serviceView(){
        $services = Service::get();
        return view('backend.service.service_view', compact('services'));
    }

    public function serviceAdd(){
        return view('backend.service.service_add');
    }

    public function serviceStore(Request $request){
        $request->validate(
            [
                'image' => 'required',
                'name' => 'required',
                'content' => 'required',
            ],
            [
                'image.required' => 'Загрузить изображение',
                'name.required' => 'Введите название продукта',
                'content.required' => 'Введите текст',
            ]
        );

        $image = $request->file('image');

        $image_name = Str::random(20);
        $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name . '.' . $ext;
        $upload_path = 'upload/service/image/';    //Creating Sub directory in Public folder to put image
        $save_url_image = $upload_path . $image_full_name;
        $success = $image->move($upload_path, $image_full_name);

        Service::create([
            'image' => $save_url_image,
            'name' => $request->name,
            'content' => $request->content,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message' => 'Услуга успешно добавлена!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.service')->with($notification);
    }

    public function serviceEdit($id){
        $service = Service::where('id', $id)->first();
        return view('backend.service.service_edit', compact('service'));
    }

    public function serviceUpdate(Request $request, $id){
        $request->validate(
            [
                'name' => 'required',
                'content' => 'required',
            ],
            [
                'name.required' => 'Введите название продукта',
                'content.required' => 'Введите текст',
            ]
        );
        $service = Service::where('id', $id)->first();
        $image = $request->file('image');
        if ($image){
            unlink($service->image);
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'upload/service/image/';    //Creating Sub directory in Public folder to put image
            $save_url_image = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
        }else{
            $save_url_image = $service->image;
        }

        $service->update([
            'image' => $save_url_image,
            'name' => $request->name,
            'content' => $request->content,
        ]);


        $notification = array(
            'message' => 'Услуга успешно изменена!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.service')->with($notification);
    }

    public function serviceDelete($id){
        $service = Service::where('id', $id)->first();
        unlink($service->image);
        $service->delete();

        $notification = array(
            'message' => 'Услуга успешно удалено!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
