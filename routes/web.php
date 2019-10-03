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
