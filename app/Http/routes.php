<?php
Route::get('/', 'HomeController@index')->name('index');

Route::group(['prefix' => 'admin'/*, 'middleware' => ['auth']*/], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('index-admin');
});

Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

Route::group(['middleware' => ['guest']], function () {

    Route::get('/login', 'Auth\AuthController@login')->name('login');
    Route::post('/login', 'Auth\AuthController@loginPost')->name('login.post');

    Route::post('/password/email', 'Auth\PasswordController@sendResetLinkEmail')->name('password-email.post');
    Route::post('/password/reset', 'Auth\PasswordController@reset')->name('password-reset.post');

    Route::get('/password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('password-reset');

    Route::get('/register', 'Auth\AuthController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\AuthController@register')->name('register.post');

});
