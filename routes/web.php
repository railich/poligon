<?php

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

// Маршрут с экшенами по умолчанию в контроллере
Route::resource('rest', 'RestTestController')->names('restTest');

// Маршруты для блога, создаем группу его маршрутов
// дополним namespace, потому что без него он будет App\Http\Controllers, а нам нужно с \Blog
// добавим префикс в путь, чтобы каждый путь не дополнять маршрутом blog\
Route::group([
    'namespace' => 'Blog',
    'prefix' => 'blog'
], function() {
    Route::resource('posts', 'PostController')  // blog/posts/... index, create.... <- resource
        ->names('blog.posts'); // имя в роутах
});

// Маршруты для авторизации
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Админка блога
$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog'
];

Route::group($groupData, function(){

    // BlogCategory
    $methods = ['index', 'edit', 'update', 'create', 'store'];

    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    //BlogPost
    Route::resource('posts', 'PostController')
        ->except(['show']) // кроме метода show
        ->names('blog.admin.posts'); // задаем имя, по которому можно обратиться через метод route('blog.admin.posts')
});