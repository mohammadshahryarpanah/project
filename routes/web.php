<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Backend\AdminController;
use \App\Http\Controllers\Frontend\UserController;
use \App\Http\Controllers\Backend\RoleController;
use \App\Http\Controllers\Backend\PermissionController;
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



Route::group(['prefix' => 'admin','middleware'=>['auth','checkPermission']], function(){

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


});
