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

//use App\Image;

//Route::get('/', function () {
/*
    $images = Image::all();
    foreach($images as $image){
        echo $image->image_path."<br>";
        echo $image->description."<br>";
        echo $image->user->name.''.$image->user->surname;

        if(count($image->comments) >=1 ){
            echo "<h4>Comentarios</h4>";
            foreach($image->comments as $comment){
                echo $comment->user->name.''.$comment->user->surname.': ';
                echo $comment->content."<br>";
            }
        }

        echo "<br> LIKES: ".count($image->likes);

        echo "<hr>";
    }

    die();*/

//return view('welcome');
//});

//GENERALS
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//USERS
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/configuration', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');

//IMAGE
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('image/save', 'ImageController@save')->name('image.save');
Route::get('/image/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('image/update', 'ImageController@update')->name('image.update');

//COMMENTS
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//LIKES
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('dislike.delete');
Route::get('/likes', 'LikeController@index')->name('likes');
