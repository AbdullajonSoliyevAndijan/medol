<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PartnerController;

use App\Http\Controllers\Frontend\IndexController as FrontendIndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [FrontendIndexController::class, 'mainPage'])->name('main.page');
//
Route::get('/ceo', [AdminController::class, 'loginForm'])->name('index');
Route::get('/ceo/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::group(['middleware' => ['admin:admin']], function () {
    Route::post('/ceo', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])
    ->get('/ceo/admin/dashboard', [IndexController::class, 'mainPage'])->name('dashboard');
//


Route::middleware(['auth:admin'])->prefix('ceo')->group(function () {

    Route::prefix('offer')->group(function () {
        Route::get('/view', [OfferController::class, 'offerView'])->name('all.offer');
        Route::get('/add', [OfferController::class, 'offerAdd'])->name('offer.add');
        Route::post('/store', [OfferController::class, 'offerStore'])->name('offer.store');
        Route::get('/edit/{id}', [OfferController::class, 'offerEdit'])->name('offer.edit');
        Route::post('/update/{id}', [OfferController::class, 'offerUpdate'])->name('offer.update');
        Route::get('/delete/{id}', [OfferController::class, 'offerDelete'])->name('offer.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/view', [ProductController::class, 'productView'])->name('all.product');
        Route::get('/add', [ProductController::class, 'productAdd'])->name('product.add');
        Route::post('/store', [ProductController::class, 'productStore'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'productUpdate'])->name('product.update');
        Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
    });

    Route::prefix('service')->group(function () {
        Route::get('/view', [ServiceController::class, 'serviceView'])->name('all.service');
        Route::get('/add', [ServiceController::class, 'serviceAdd'])->name('service.add');
        Route::post('/store', [ServiceController::class, 'serviceStore'])->name('service.store');
        Route::get('/edit/{id}', [ServiceController::class, 'serviceEdit'])->name('service.edit');
        Route::post('/update/{id}', [ServiceController::class, 'serviceUpdate'])->name('service.update');
        Route::get('/delete/{id}', [ServiceController::class, 'serviceDelete'])->name('service.delete');
    });

    Route::prefix('news')->group(function () {
        Route::get('/view', [NewsController::class, 'newsView'])->name('all.news');
        Route::get('/add', [NewsController::class, 'newsAdd'])->name('news.add');
        Route::post('/store', [NewsController::class, 'newsStore'])->name('news.store');
        Route::get('/edit/{id}', [NewsController::class, 'newsEdit'])->name('news.edit');
        Route::post('/update/{id}', [NewsController::class, 'newsUpdate'])->name('news.update');
        Route::get('/delete/{id}', [NewsController::class, 'newsDelete'])->name('news.delete');
    });

    Route::prefix('partner')->group(function () {
        Route::get('/view', [PartnerController::class, 'partnerView'])->name('all.partner');
        Route::get('/add', [PartnerController::class, 'partnerAdd'])->name('partner.add');
        Route::post('/store', [PartnerController::class, 'partnerStore'])->name('partner.store');
        Route::get('/edit/{id}', [PartnerController::class, 'partnerEdit'])->name('partner.edit');
        Route::post('/update/{id}', [PartnerController::class, 'partnerUpdate'])->name('partner.update');
        Route::get('/delete/{id}', [PartnerController::class, 'partnerDelete'])->name('partner.delete');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/view', [SettingController::class, 'settingView'])->name('all.setting');
        Route::post('/store', [SettingController::class, 'settingStore'])->name('setting.store');
        Route::get('/edit/{id}', [SettingController::class, 'settingEdit'])->name('setting.edit');
        Route::post('/update/{id}', [SettingController::class, 'settingUpdate'])->name('setting.update');
    });


});
