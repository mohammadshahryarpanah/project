<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Backend\AdminController;
use \App\Http\Controllers\Frontend\UserController;
use \App\Http\Controllers\Backend\RoleController;
use \App\Http\Controllers\Backend\PermissionController;
use \App\Http\Controllers\Backend\CityController;
use \App\Http\Controllers\Backend\SellerTypeController;
use \App\Http\Controllers\Backend\SellerController;
use \App\Http\Controllers\Backend\TicketController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('register',[UserController::class,'showRegister']);
Route::post('/user/create',[UserController::class,'register'])->name('user.register');


Route::get('login',[UserController::class,'showLogin'])->name('login');
Route::post('/user/login',[UserController::class,'login'])->name('user.login');



Route::group(['prefix' => 'admin'], function(){

    Route::get('index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('create/user', [AdminController::class, 'show'])->name('admin.create');
    Route::post('store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('edit/{user_id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/update/{user_id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('destroy/{user_id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('create/role',[RoleController::class,'create'])->name('role.create');
    Route::get('edit/role/{role_id}',[RoleController::class,'edit'])->name('role.edit');
    Route::get('index/role',[RoleController::class,'index'])->name('role.index');
    Route::post('store/role',[RoleController::class,'store'])->name('role.store');
    Route::delete('destroy/role/{role_id}',[RoleController::class,'destroy'])->name('role.destroy');
    Route::put('update/role/{role_id}',[RoleController::class,'update'])->name('role.update');


    Route::get('create/permission',[PermissionController::class,'create'])->name('permission.create');
    Route::get('edit/permission/{permission_id}',[PermissionController::class,'edit'])->name('permission.edit');
    Route::get('index/permission',[PermissionController::class,'index'])->name('permission.index');
    Route::post('store/permission',[PermissionController::class,'store'])->name('permission.store');
    Route::delete('destroy/permission/{permission_id}',[PermissionController::class,'destroy'])->name('permission.destroy');
    Route::put('update/permission/{permission_id}',[PermissionController::class,'update'])->name('permission.update');


    Route::get('create/city',[CityController::class,'create'])->name('city.create');
    Route::get('edit/city/{city_id}',[CityController::class,'edit'])->name('city.edit');
    Route::get('index/city',[CityController::class,'index'])->name('city.index');
    Route::post('store/city',[CityController::class,'store'])->name('city.store');
    Route::delete('destroy/city/{city_id}',[CityController::class,'destroy'])->name('city.destroy');
    Route::put('update/city/{city_id}',[CityController::class,'update'])->name('city.update');

    Route::get('create/seller/type',[SellerTypeController::class,'create'])->name('type.create');
    Route::get('edit/seller/type/{type_id}',[SellerTypeController::class,'edit'])->name('type.edit');
    Route::get('index/seller/type',[SellerTypeController::class,'index'])->name('type.index');
    Route::post('store/seller/type',[SellerTypeController::class,'store'])->name('type.store');
    Route::delete('destroy/seller/type/{type_id}',[SellerTypeController::class,'destroy'])->name('type.destroy');
    Route::put('update/seller/type/{type_id}',[SellerTypeController::class,'update'])->name('type.update');

    Route::get('create/seller',[SellerController::class,'create'])->name('seller.create');
    Route::get('edit/seller/{seller_id}',[SellerController::class,'edit'])->name('seller.edit');
    Route::get('index/seller',[SellerController::class,'index'])->name('seller.index');
    Route::post('store/seller',[SellerController::class,'store'])->name('seller.store');
    Route::delete('destroy/seller/{seller_id}',[SellerController::class,'destroy'])->name('seller.destroy');
    Route::put('update/seller/{seller_id}',[SellerController::class,'update'])->name('seller.update');


    Route::get('create/ticket',[TicketController::class,'create'])->name('ticket.create');
    Route::get('edit/ticket/{ticket_id}',[TicketController::class,'edit'])->name('ticket.edit');
    Route::get('index/ticket',[TicketController::class,'index'])->name('ticket.index');
    Route::post('store/ticket',[TicketController::class,'store'])->name('ticket.store');
    Route::delete('destroy/ticket/{ticket_id}',[TicketController::class,'destroy'])->name('ticket.destroy');
    Route::put('update/ticket/{ticket_id}',[TicketController::class,'update'])->name('ticket.update');


});
