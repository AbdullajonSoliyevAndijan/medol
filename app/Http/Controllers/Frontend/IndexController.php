<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Offer;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;

class IndexController extends Controller
{
    public function mainPage(){
        $setting = Setting::first();
        $offers = Offer::get();
        $products = Product::get();
        $services = Service::get();
        $news = News::get();
        $partners = Partner::get();

        return view('frontend.main', compact('setting', 'offers', 'products',
            'services', 'news', 'partners'));
    }

}
