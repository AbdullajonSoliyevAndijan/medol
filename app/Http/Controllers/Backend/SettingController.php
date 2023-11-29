<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function settingView(){
        $setting = Setting::first();
        return view('backend.setting.setting_view', compact('setting'));
    }

    public function settingStore(Request $request){
        $request->validate(
            [
                'logo' => 'required',
                'address' => 'required',
                'address_number' => 'required',
                'first_phone' => 'required',
                'second_phone' => 'required',
                'facebook_url' => 'required',
                'email' => 'required',
                'about' => 'required',
                'target' => 'required',
            ],
            [
                'logo.required' => 'Загрузите свой логотип',
                'address.required' => 'Введите адрес',
                'address_number.required' => 'Введите номер адреса',
                'first_phone.required' => 'Введите первый номер телефона',
                'second_phone.required' => 'Введите второй номер телефона',
                'facebook_url.required' => 'Введите ссылку на Facebook',
                'email.required' => 'Введите адрес электронной почты',
                'about.required' => 'Войти о компании',
                'target.required' => 'Войти цель',
            ]
        );

        $logo = $request->file('logo');

        $logo_name = Str::random(20);
        $ext = strtolower($logo->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $logo_full_name = $logo_name . '.' . $ext;
        $upload_path = 'upload/brand/logo/';    //Creating Sub directory in Public folder to put logo
        $save_url_logo = $upload_path . $logo_full_name;
        $success = $logo->move($upload_path, $logo_full_name);

        Setting::create([
            'logo' => $save_url_logo,
            'address' => $request->address,
            'address_number' => $request->address_number,
            'first_phone' => $request->first_phone,
            'second_phone' => $request->second_phone,
            'facebook_url' => $request->facebook_url,
            'email' => $request->email,
            'about' => $request->about,
            'target' => $request->target,
            'created_at' => Carbon::now()
        ]);


        $notification = array(
            'message' => 'Настройка успешно добавлена!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function settingEdit($id){
        $setting = Setting::where('id', $id)->first();
        return view('backend.setting.setting_edit', compact('setting'));
    }

    public function settingUpdate(Request $request, $id){
        $request->validate(
            [
                'address' => 'required',
                'address_number' => 'required',
                'first_phone' => 'required',
                'second_phone' => 'required',
                'facebook_url' => 'required',
                'email' => 'required',
                'about' => 'required',
            ],
            [
                'address.required' => 'Введите адрес',
                'address_number.required' => 'Введите номер адреса',
                'first_phone.required' => 'Введите первый номер телефона',
                'second_phone.required' => 'Введите второй номер телефона',
                'facebook_url.required' => 'Введите ссылку на Facebook',
                'email.required' => 'Введите адрес электронной почты',
                'about.required' => 'Войти о компании',
            ]
        );
        $setting = Setting::where('id', $id)->first();
        $logo = $request->file('logo');
        if ($logo){
            $logo_name = Str::random(20);
            $ext = strtolower($logo->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $logo_full_name = $logo_name . '.' . $ext;
            $upload_path = 'upload/brand/logo/';    //Creating Sub directory in Public folder to put logo
            $save_url_logo = $upload_path . $logo_full_name;
            $success = $logo->move($upload_path, $logo_full_name);
        }else{
            $save_url_logo = $setting->logo;
        }

        $setting->update([
            'logo' => $save_url_logo,
            'address' => $request->address,
            'address_number' => $request->address_number,
            'first_phone' => $request->first_phone,
            'second_phone' => $request->second_phone,
            'facebook_url' => $request->facebook_url,
            'email' => $request->email,
            'about' => $request->about,
            'target' => $request->target,
        ]);


        $notification = array(
            'message' => 'Настройка успешно изменена!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.setting')->with($notification);
    }
}
