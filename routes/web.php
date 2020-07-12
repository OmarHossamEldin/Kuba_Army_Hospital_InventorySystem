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
Route::group(['middleware'=>['auth','SaftyQuestion']],function(){

    Route::resource('users','UserController'); //users

    Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');// users dashboard

    Route::get('/resetPassword','PasswordRestController@resetPassword')->name('resetPassword'); //resetPassword

    Route::post('/ChangingPassword','PasswordRestController@ChangingPassword')->name('ChangingPassword'); //ChangingPassword

    Route::get('/signout','PageController@signout')->name('signout'); //logout

    Route::get('/user/activites','UserController@user_activites_view')->name('activites.index'); // get the view activites of users view

    Route::post('/user/activites','UserController@user_activites')->name('activites.data'); // get the view activites of users

    Route::post('/usernames','UserController@usernames')->name('username.autocomplete'); // get the of usersnames

    Route::resource('categories','CategoryController'); //categories

    Route::resource ('products','ProductsController'); //products

    Route::post('/item','ProductsController@item')->name('stock.autocomplete');   //to get item for purchase

    Route::post('/itemselection','ProductsController@itemselection')->name('stock.data');  //to get item for checking stock details

    Route::post('/itemid','ProductsController@itemid')->name('item.id.using.name');  //to get itemid for imports

    Route::post('/iteminfo','ProductsController@iteminfo')->name('item.info');   //to get info for imports

    Route::get('/imports/create','ImportsController@create')->name('imports.create');   //imports create view

    Route::post('/imports','ImportsController@store')->name('imports.store');   //imports store

    Route::get('/imports','ImportsController@index')->name('imports');   //all imports

    Route::get('/importshistory/{start}/{end}','ImportsController@inputhistory')->name('imports.history');   //all imports history

    Route::get('/imports/show/{import}','ImportsController@show')->name('imports.show');   // import show details

    Route::delete('/imports/{import}','ImportsController@delete')->name('imports.delete');   // import delete 

    Route::get('/outputs/create','OutputController@create')->name('outputs.create');   //outputs create view

    Route::post('/outputs','OutputController@store')->name('outputs.store');   //outputs store

    Route::get('/outputs','OutputController@index')->name('outputs');   //all outputs

    Route::get('/outputshistory/{start}/{end}','OutputController@outputhistory')->name('outputs.history');   //all outputs history

    Route::get('/outputs/show/{output}','OutputController@show')->name('outputs.show');   // output show details

    Route::delete('/outputs/{output}','OutputController@delete')->name('outputs.delete');   // output delete 

});

Route::group(['middleware'=>'auth'],function(){

    Route::get('/saftyquestion/create','SaftyQuestionController@create')->name('SaftyQuestion');

    Route::post('/saftyquestion','SaftyQuestionController@store')->name('SaftyQuestion.store');

});

Route::group(['middleware'=>'guest'],function(){

    Route::get('/','PageController@loginForm')->name('login');//login page

    Route::post('/signin','PageController@signin')->name('signin');//signIn

    Route::get('/checkUserName','SaftyQuestionController@checkUserNameForm')->name('checkUserName'); //forgetPassword form

    Route::post('/checkUserName','SaftyQuestionController@checkUserName')->name('checkUserName'); //get question

    Route::post('/answer/{User}','SaftyQuestionController@checkTheAnswer')->name('checkTheAnswer'); //checkTheAnswer

});


