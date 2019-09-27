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


Auth::routes();
//route for home
Route::get('/', 'HomeController@index')->name('home');

//route for the user avatar 
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');

//routes for the configuration of the user account
Route::get('/configuration', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');

//routes for upload, view, save and detail image
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/save', 'ImageController@save')->name('image.save');
Route::get('/image/{id}', 'ImageController@detail')->name('image.detail');

//routes for save and delete comments
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//routes for give like and dislike
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('dislike.delete');
Route::get('/likes', 'LikeController@index')->name('likes');

//route for user profile
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
