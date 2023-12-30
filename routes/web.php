<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth',
])->group(function () {

    //dashboard
    Route::get('dashboard', [authController::class, 'dashboardpage'])->name('auth#dashboard');

    //Admin
    Route::middleware('Admin_auth')->group(function () {
        //admin category
        Route::prefix('category')->group(function () {
            Route::get('/list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'page'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });
        
        //admin account
        Route::prefix('admin')->group(function () {
            //admin account password change
            Route::get('password/changePage', [AdminController::class, 'changePage'])->name('pass#changePage');
            Route::post('password/change', [AdminController::class, 'change'])->name('pass#change');

            //admin account Page
            Route::get('accountPage',[AdminController::class,'account'])->name('account#Page');
            Route::get('editPage',[AdminController::class,'edit'])->name('account#edit');
            Route::post('account/update/{id}',[AdminController::class,'update'])->name('account#update');

            //admin account list
            Route::get('listPage',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::post('rolechange/{id}',[AdminController::class,'rolechange'])->name('admin#role');
        });

        

        //Pizza Products
        Route::prefix('pizza')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('pizza#list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('pizza#createPage');
            Route::post('create',[ProductController::class,'create'])->name('pizza#create');
            Route::get('detailPage/{id}',[ProductController::class,'detail'])->name('pizza#detail');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('pizza#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('pizza#edit');
            Route::post('update',[ProductController::class,'update'])->name('pizza#update');
        });
    });

    //user home
    Route::middleware('User_auth')->group(function () {
        Route::prefix('user')->group(function(){
            Route::get('home', [userController::class, 'home'])->name('user#home');
            Route::get('passwordPage',[userController::class,'Password'])->name('passchange#Page');
            Route::post('passwordChange',[userController::class,'change'])->name('pass#change');
            Route::get('account/editPage',[userController::class,'accedit'])->name('user#accedit');
            Route::post('account/update/{id}',[userController::class,'update'])->name('user#accupdate');
        });
    });
});

//login & register page

Route::middleware('Login_RegisterAuth')->group(function(){
    Route::redirect('/', 'loginPage');

    Route::get('loginPage', [authController::class, 'loginPage'])->name('auth#login');
    
    Route::get('registerPage', [authController::class, 'registerPage'])->name('auth#register');    
});

