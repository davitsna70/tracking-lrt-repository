<?php
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 17/07/2017
 * Time: 9:04
 */

Route::group(['prefix'=>'timeline'],function (){
    Route::get('/', 'MenuTimelineController@timeline');
    Route::get('/specific/', 'MenuTimelineController@timelineActivityWithSpesification');
});

Route::group(['prefix'=>'activity'],function (){
    Route::get('/', 'MenuActivityController@index');
    Route::get('/access_right/', 'MenuActivityController@indexWithAccessRight');
    Route::get('/create', 'MenuActivityController@create');
    Route::post('/save', 'MenuActivityController@save');
    Route::get('/{id}/edit', 'MenuActivityController@edit');
    Route::put('/{id}/save_change/', 'MenuActivityController@update');
    Route::get('/search_by_name', 'MenuActivityController@searchByName');
    Route::get('/{id}/show', 'MenuActivityController@show');
    Route::get('/list_to_do/done/{id}', 'MenuActivityController@doneListToDo');
    Route::get('/list_to_do/undone/{id}', 'MenuActivityController@undoneListToDo');
    Route::get('/list_to_do/delete/{id}/{id2}', 'MenuActivityController@listToDoDelete');
    Route::get('/member/delete/{id}/{id2}', 'MenuActivityController@memberDelete');
    Route::post('comment/{id}', 'MenuActivityController@comment');
});

Route::group(['prefix'=>'archive'],function (){
    Route::get('/', 'MenuArchiveController@archive');
    Route::get('/add/{id}', 'MenuArchiveController@addToArchive');
    Route::get('/delete/{id}', 'MenuArchiveController@deleteFromArchive');
});

Route::group(['prefix'=>'help'],function (){
    Route::get('/how_to_use', 'MenuHelpController@howToUse');
    Route::get('/information', 'MenuHelpController@information');
    Route::get('/about', 'MenuHelpController@about');
    Route::get('/contact', 'MenuHelpController@contact');
});

Route::group(['prefix'=>'list_to_do'],function (){
    Route::get('/', 'MenuListToDoController@listToDo');
});

Route::group(['prefix'=>'log_activity'],function (){
    Route::get('/', 'MenuLogActivityController@logActivity');
});

//Route::group(['prefix'=>'message'],function (){
//    Route::get('/', 'MenuMessageController@index');
//});

Route::group(['prefix'=>'notification'],function (){
    Route::get('/', 'MenuNotificationController@notificationPage');
    Route::get('/read', 'MenuNotificationController@readNotification');
    Route::get('/task', 'MenuNotificationController@notificationTask');
});

Route::group(['prefix'=>'profile'],function (){
    Route::get('/', 'MenuProfileController@selfProfile');
    Route::get('/person/{id}', 'MenuProfileController@otherProfile');
    Route::get('/team', 'MenuProfileController@selfTeamProfile');
    Route::get('/team/{id}', 'MenuProfileController@otherTeamProfile');
    Route::get('/reset_password', 'MenuProfileController@resetPassword');
    Route::put('/reset_password', 'MenuProfileController@saveResetPassword');
    Route::get('/update/person', 'MenuProfileController@changeProfilePerson');
    Route::put('/update/person', 'MenuProfileController@updateProfilePerson');
    Route::get('/update/team', 'MenuProfileController@changeProfileTeam');
    Route::put('/update/team', 'MenuProfileController@updateProfileTeam');
    Route::get('/reset_password', 'MenuProfileController@resetPassword');
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

Route::group(['prefix'=>'viewer'],function (){
    Route::get('/', 'MenuViewerController@index')->middleware('auth');
    Route::get('/create', 'MenuViewerController@create')->middleware('auth');
    Route::post('/save', 'MenuViewerController@store')->middleware('auth');
    Route::get('{id}/show', 'MenuViewerController@show')->middleware('auth');
    Route::get('{id}/edit', 'MenuViewerController@edit')->middleware('auth');
    Route::put('{id}/update', 'MenuViewerController@update')->middleware('auth');
    Route::delete('{id}/delete', 'MenuViewerController@destroy')->middleware('auth');
});
