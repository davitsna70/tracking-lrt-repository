<?php
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 17/07/2017
 * Time: 9:04
 */

Route::group(['prefix'=>'timeline'],function (){
    Route::get('/', 'MenuTimelineController@timeline')->middleware('auth');
    Route::get('/specific/', 'MenuTimelineController@timelineActivityWithSpesification')->middleware('auth');
});

Route::group(['prefix'=>'activity'],function (){
    Route::get('/', 'MenuActivityController@index')->middleware('auth');
    Route::get('/access_right/', 'MenuActivityController@indexWithAccessRight')->middleware('auth');
    Route::get('/create', 'MenuActivityController@create')->middleware('auth');
    Route::post('/save', 'MenuActivityController@save')->middleware('auth');
    Route::get('/{id}/edit', 'MenuActivityController@edit')->middleware('auth');
    Route::put('/{id}/save_change/', 'MenuActivityController@update')->middleware('auth');
    Route::get('/search_by_name', 'MenuActivityController@searchByName')->middleware('auth');
    Route::get('/{id}/show', 'MenuActivityController@show')->middleware('auth');
    Route::get('/list_to_do/done/{id}', 'MenuActivityController@doneListToDo')->middleware('auth');
    Route::get('/list_to_do/undone/{id}', 'MenuActivityController@undoneListToDo')->middleware('auth');
    Route::get('/list_to_do/delete/{id}/{id2}', 'MenuActivityController@listToDoDelete')->middleware('auth');
    Route::get('/member/delete/{id}/{id2}', 'MenuActivityController@memberDelete')->middleware('auth');
    Route::post('comment/{id}', 'MenuActivityController@comment')->middleware('auth');
});

Route::group(['prefix'=>'archive'],function (){
    Route::get('/', 'MenuArchiveController@archive')->middleware('auth');
    Route::get('/add/{id}', 'MenuArchiveController@addToArchive')->middleware('auth');
    Route::get('/delete/{id}', 'MenuArchiveController@deleteFromArchive')->middleware('auth');
});

Route::group(['prefix'=>'help'],function (){
    Route::get('/how_to_use', 'MenuHelpController@howToUse')->middleware('auth');
    Route::get('/information', 'MenuHelpController@information')->middleware('auth');
    Route::get('/about', 'MenuHelpController@about')->middleware('auth');
    Route::get('/contact', 'MenuHelpController@contact')->middleware('auth');
});

Route::group(['prefix'=>'list_to_do'],function (){
    Route::get('/', 'MenuListToDoController@listToDo')->middleware('auth');
});

Route::group(['prefix'=>'log_activity'],function (){
    Route::get('/', 'MenuLogActivityController@logActivity')->middleware('auth');
});

//Route::group(['prefix'=>'message'],function (){
//    Route::get('/', 'MenuMessageController@index');
//});

Route::group(['prefix'=>'notification'],function (){
    Route::get('/', 'MenuNotificationController@notificationPage')->middleware('auth');
    Route::get('/read', 'MenuNotificationController@readNotification')->middleware('auth');
    Route::get('/task', 'MenuNotificationController@notificationTask')->middleware('auth');
});

Route::group(['prefix'=>'profile'],function (){
    Route::get('/', 'MenuProfileController@selfProfile')->middleware('auth');
    Route::get('/person/{id}', 'MenuProfileController@otherProfile')->middleware('auth');
    Route::get('/team', 'MenuProfileController@selfTeamProfile')->middleware('auth');
    Route::get('/team/{id}', 'MenuProfileController@otherTeamProfile')->middleware('auth');
    Route::get('/reset_password', 'MenuProfileController@resetPassword')->middleware('auth');
    Route::put('/reset_password', 'MenuProfileController@saveResetPassword')->middleware('auth');
    Route::get('/update/person', 'MenuProfileController@changeProfilePerson')->middleware('auth');
    Route::put('/update/person', 'MenuProfileController@updateProfilePerson')->middleware('auth');
    Route::get('/update/team', 'MenuProfileController@changeProfileTeam')->middleware('auth');
    Route::put('/update/team', 'MenuProfileController@updateProfileTeam')->middleware('auth');
    Route::get('/reset_password', 'MenuProfileController@resetPassword')->middleware('auth');
});

Route::group(['prefix'=>'group_admin'],function (){
    Route::get('/', 'MenuGroupAdminController@index')->middleware('auth');
    Route::get('/create', 'MenuGroupAdminController@create')->middleware('auth');
    Route::post('/save', 'MenuGroupAdminController@store')->middleware('auth');
    Route::get('{id}/show', 'MenuGroupAdminController@show')->middleware('auth');
    Route::get('{id}/edit', 'MenuGroupAdminController@edit')->middleware('auth');
    Route::put('{id}/update', 'MenuGroupAdminController@update')->middleware('auth');
    Route::delete('{id}/delete', 'MenuGroupAdminController@destroy')->middleware('auth');
});

Route::group(['prefix'=>'member_group'],function (){
    Route::get('/', 'MenuMemberGroupController@index')->middleware('auth');
    Route::get('/create', 'MenuMemberGroupController@create')->middleware('auth');
    Route::post('/save', 'MenuMemberGroupController@store')->middleware('auth');
    Route::get('{id}/show', 'MenuMemberGroupController@show')->middleware('auth');
    Route::get('{id}/edit', 'MenuMemberGroupController@edit')->middleware('auth');
    Route::put('{id}/update', 'MenuMemberGroupController@update')->middleware('auth');
    Route::delete('{id}/delete', 'MenuMemberGroupController@destroy')->middleware('auth');
});

//Route::group(['prefix'=>'viewer'],function (){
//    Route::get('/', 'MenuViewerController@index')->middleware('auth');
//    Route::get('/create', 'MenuViewerController@create')->middleware('auth');
//    Route::post('/save', 'MenuViewerController@store')->middleware('auth');
//    Route::get('{id}/show', 'MenuViewerController@show')->middleware('auth');
//    Route::get('{id}/edit', 'MenuViewerController@edit')->middleware('auth');
//    Route::put('{id}/update', 'MenuViewerController@update')->middleware('auth');
//    Route::delete('{id}/delete', 'MenuViewerController@destroy')->middleware('auth');
//});
