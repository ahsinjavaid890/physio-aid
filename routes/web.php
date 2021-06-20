<?php

use Illuminate\Support\Facades\Route;


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
Route::get('/', [App\Http\Controllers\SiteController::class, 'indexview'])->name('home');
Route::get('/{id}', [App\Http\Controllers\SiteController::class, 'checkurl']);
Route::POST('/registerdoctor', [App\Http\Controllers\Doctorregister::class, 'store']);


Auth::routes();
Route::get('/user-dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('user-dashboard');
Route::get('/user-profile', [App\Http\Controllers\HomeController::class, 'profile']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'homedashboard']);
Route::POST('/updateuserprofile', [App\Http\Controllers\HomeController::class, 'updateuserprofile']);
Route::POST('/updateusersociallinks', [App\Http\Controllers\HomeController::class, 'updateusersociallinks']);
Route::POST('/updateusersecurity', [App\Http\Controllers\HomeController::class, 'updateusersecurity']);
Route::POST('createnewcase', [App\Http\Controllers\SiteController::class, 'createnewcase']);
Route::POST('comment', [App\Http\Controllers\SiteController::class, 'comment']);
Route::get('search/{one}/{two}/{three}', [App\Http\Controllers\SiteController::class, 'searchpage']);
Route::POST('registernewuser', [App\Http\Controllers\SiteController::class, 'registernewuser']);
Route::POST('/submitcontactus',[App\Http\Controllers\SiteController::class, 'submitcontactus']);
Route::get('followmember/{id}', [App\Http\Controllers\SiteController::class, 'followmember']);
Route::get('unfollowmember/{id}', [App\Http\Controllers\SiteController::class, 'unfollowmember']);
Route::get('editcase/{id}', [App\Http\Controllers\SiteController::class, 'editcase']);
Route::POST('/updatecasedetails',[App\Http\Controllers\SiteController::class, 'updatecasedetails']);
Route::get('deletecase/{id}', [App\Http\Controllers\SiteController::class, 'deletecase']);
Route::get('getsubcategory/{id}', [App\Http\Controllers\SiteController::class, 'getsubcategory']);
Route::POST('updatecaseimage', [App\Http\Controllers\SiteController::class, 'updatecaseimage']);
Route::POST('updatecasegalaryimage', [App\Http\Controllers\SiteController::class, 'updatecasegalaryimage']);
Route::get('searchcategory/{id}', [App\Http\Controllers\SiteController::class, 'searchcategory']);
Route::get('searchmembers/{id}/{two}', [App\Http\Controllers\SiteController::class, 'searchmembers']);
Route::get('showimage/{id}', [App\Http\Controllers\SiteController::class, 'showimage']);
Route::get('submitreply/{id}/{value}', [App\Http\Controllers\SiteController::class, 'submitreply']);

Route::get('sortbyrattings/{id}', [App\Http\Controllers\SiteController::class, 'sortbyrattings']);
Route::get('sortbydate/{id}', [App\Http\Controllers\SiteController::class, 'sortbydate']);




// Admin Routes

Route::get('admin/dashboard', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.dashboard')->middleware('is_admin');
Route::get('admin/profile', [App\Http\Controllers\AdminController::class, 'profile']);
Route::get('admin/new/category', function () {
   return view('admin.add-category');
});
Route::get('admin/category', function () {
   return view('admin.add-category');
});
Route::get('admin/categories', [App\Http\Controllers\AdminController::class, 'categories']);
Route::get('admin/category/edit/{id}', [App\Http\Controllers\AdminController::class, 'editcategory']);
Route::POST('/createcategory', [App\Http\Controllers\AdminController::class, 'createcategory']);
Route::POST('/updatecategory', [App\Http\Controllers\AdminController::class, 'updatecategory']);
Route::get('admin/new/subcategory', [App\Http\Controllers\AdminController::class, 'addsubcategory']);
Route::POST('/createsubcategory', [App\Http\Controllers\AdminController::class, 'createsubcategory']);
Route::get('admin/subcategories', [App\Http\Controllers\AdminController::class, 'subcategories']);
Route::get('admin/edit/subcategory/{id}', [App\Http\Controllers\AdminController::class, 'editsubcategory']);
Route::POST('/updatesubcategory', [App\Http\Controllers\AdminController::class, 'updatesubcategory']);
Route::get('admin/new/case', [App\Http\Controllers\AdminController::class, 'addnewcase']);
Route::get('admin/messages', [App\Http\Controllers\AdminController::class, 'messages']);
Route::get('/admin/add-blog', function () {
    return view('admin.add-blog');
});
Route::POST('/createblog', [App\Http\Controllers\AdminController::class, 'createblog']);
Route::get('admin/blogs', [App\Http\Controllers\AdminController::class, 'blogs']);
Route::get('changetopublish/{one}/{two}', [App\Http\Controllers\AdminController::class, 'changetopublish']);
Route::get('deleteblog/{one}', [App\Http\Controllers\AdminController::class, 'deleteblog']);
Route::get('/admin/edit/blog/{one}', [App\Http\Controllers\AdminController::class, 'editblog']);
Route::POST('/updateblog', [App\Http\Controllers\AdminController::class, 'updateblog']);
Route::POST('/updateblogimage', [App\Http\Controllers\AdminController::class, 'updateblogimage']);
Route::POST('/updatecaseguide', [App\Http\Controllers\AdminController::class, 'updatecaseguide']);



Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users']);
Route::get('/admin/cases', [App\Http\Controllers\AdminController::class, 'cases']);
Route::get('changetopublishcase/{one}/{two}', [App\Http\Controllers\AdminController::class, 'changetopublishcase']);
Route::get('/admin/websitesettings',[App\Http\Controllers\AdminController::class, 'websitesettings']);
// Site Settings Routs Admin
Route::POST('/updatecontactdetails',[App\Http\Controllers\AdminController::class, 'updatecontactdetails']);
Route::POST('/updatesocialmedialinks',[App\Http\Controllers\AdminController::class, 'updatesocialmedialinks']);
Route::POST('/updatefootertext',[App\Http\Controllers\AdminController::class, 'updatefootertext']);
Route::get('/admin/view/message/{id}',[App\Http\Controllers\AdminController::class, 'message']);
Route::get('/deletecategory/{id}',[App\Http\Controllers\AdminController::class, 'deletecategory']);
Route::get('/deletesubcategory/{id}',[App\Http\Controllers\AdminController::class, 'deletesubcategory']);
Route::get('/admin/editcase/{id}',[App\Http\Controllers\AdminController::class, 'editcase']);
Route::get('/deleteuser/{id}',[App\Http\Controllers\AdminController::class, 'deleteuser']);

