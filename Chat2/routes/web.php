<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PostController;

use App\Http\Middleware\LoginMemberCheck;
use App\Http\Middleware\ShowPosts;

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


Route::get('mypage/login',[MainController::class,'login_index']);
Route::post('mypage/home',[MainController::class,'login']);
Route::get('mypage/home',[MainController::class,'home_index'])->middleware(LoginMemberCheck::class)->middleware(ShowPosts::class);

Route::get('member/add',[MemberController::class,'add']);
Route::post('member/add',[MemberController::class,'create']);

Route::get('mypage/member_delete',[MemberController::class,'delete_index'])->middleware(LoginMemberCheck::class);
Route::post('mypage/member_delete',[MemberCOntroller::class,'delete']);

Route::post('mypage/post',[PostController::class,'post'])->middleware(ShowPosts::class);
Route::get('mypage/post',[MainController::class,'home_index'])->middleware(ShowPosts::class)->middleware(LoginMemberCheck::class);

Route::get('mypage/post_delete',[PostController::class,'delete_index'])->middleware(LoginMemberCheck::class);
Route::post('mypage/post_delete',[PostController::class,'delete'])->middleware(ShowPosts::class);

Route::get('mypage/post_indivisual',[PostController::class,'individual'])->middleware(LoginMemberCheck::class);
Route::post('mypage/reply',[PostController::class,'reply']);

