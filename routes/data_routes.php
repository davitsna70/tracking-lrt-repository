<?php
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 06/07/2017
 * Time: 8:47
 */

Route::group(['prefix'=>'data'],function (){
    Route::group(['prefix'=>'user'],function (){
        Route::get('/', 'UserController@index')->middleware('auth');
        Route::get('/create', 'UserController@create')->middleware('auth');
        Route::post('/save', 'UserController@store')->middleware('auth');
        Route::get('{id}/show', 'UserController@show')->middleware('auth');
        Route::get('{id}/edit', 'UserController@edit')->middleware('auth');
        Route::put('{id}/update', 'UserController@update')->middleware('auth');
        Route::delete('{id}/delete', 'UserController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'profile'],function (){
        Route::get('/', 'ProfileController@index')->middleware('auth');
        Route::get('/create', 'ProfileController@create')->middleware('auth');
        Route::post('/save', 'ProfileController@store')->middleware('auth');
        Route::get('{id}/show', 'ProfileController@show')->middleware('auth');
        Route::get('{id}/edit', 'ProfileController@edit')->middleware('auth');
        Route::put('{id}/update', 'ProfileController@update')->middleware('auth');
        Route::delete('{id}/delete', 'ProfileController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'user_activity'],function (){
        Route::get('/', 'UserActivityController@index')->middleware('auth');
        Route::get('/create', 'UserActivityController@create')->middleware('auth');
        Route::post('/save', 'UserActivityController@store')->middleware('auth');
        Route::get('{id}/show', 'UserActivityController@show')->middleware('auth');
        Route::get('{id}/edit', 'UserActivityController@edit')->middleware('auth');
        Route::put('{id}/update', 'UserActivityController@update')->middleware('auth');
        Route::delete('{id}/delete', 'UserActivityController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'activity'],function (){
        Route::get('/', 'ActivityController@index')->middleware('auth');
        Route::get('/create', 'ActivityController@create')->middleware('auth');
        Route::post('/save', 'ActivityController@store')->middleware('auth');
        Route::get('{id}/show', 'ActivityController@show')->middleware('auth');
        Route::get('{id}/edit', 'ActivityController@edit')->middleware('auth');
        Route::put('{id}/update', 'ActivityController@update')->middleware('auth');
        Route::delete('{id}/delete', 'ActivityController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'archive'],function (){
        Route::get('/', 'ArchiveController@index')->middleware('auth');
        Route::get('/create', 'ArchiveController@create')->middleware('auth');
        Route::post('/save', 'ArchiveController@store')->middleware('auth');
        Route::get('{id}/show', 'ArchiveController@show')->middleware('auth');
        Route::get('{id}/edit', 'ArchiveController@edit')->middleware('auth');
        Route::put('{id}/update', 'ArchiveController@update')->middleware('auth');
        Route::delete('{id}/delete', 'ArchiveController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'attachment_activity'],function (){
        Route::get('/', 'AttachmentActivityController@index')->middleware('auth');
        Route::get('/create', 'AttachmentActivityController@create')->middleware('auth');
        Route::post('/save', 'AttachmentActivityController@store')->middleware('auth');
        Route::get('{id}/show', 'AttachmentActivityController@show')->middleware('auth');
        Route::get('{id}/edit', 'AttachmentActivityController@edit')->middleware('auth');
        Route::put('{id}/update', 'AttachmentActivityController@update')->middleware('auth');
        Route::delete('{id}/delete', 'AttachmentActivityController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'attachment_comment'],function (){
        Route::get('/', 'AttachmentCommentController@index')->middleware('auth');
        Route::get('/create', 'AttachmentCommentController@create')->middleware('auth');
        Route::post('/save', 'AttachmentCommentController@store')->middleware('auth');
        Route::get('{id}/show', 'AttachmentCommentController@show')->middleware('auth');
        Route::get('{id}/edit', 'AttachmentCommentController@edit')->middleware('auth');
        Route::put('{id}/update', 'AttachmentCommentController@update')->middleware('auth');
        Route::delete('{id}/delete', 'AttachmentCommentController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'attachment_list_to_do'],function (){
        Route::get('/', 'AttachmentListToDoController@index')->middleware('auth');
        Route::get('/create', 'AttachmentListToDoController@create')->middleware('auth');
        Route::post('/save', 'AttachmentListToDoController@store')->middleware('auth');
        Route::get('{id}/show', 'AttachmentListToDoController@show')->middleware('auth');
        Route::get('{id}/edit', 'AttachmentListToDoController@edit')->middleware('auth');
        Route::put('{id}/update', 'AttachmentListToDoController@update')->middleware('auth');
        Route::delete('{id}/delete', 'AttachmentListToDoController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'comment'],function (){
        Route::get('/', 'CommentController@index')->middleware('auth');
        Route::get('/create', 'CommentController@create')->middleware('auth');
        Route::post('/save', 'CommentController@store')->middleware('auth');
        Route::get('{id}/show', 'CommentController@show')->middleware('auth');
        Route::get('{id}/edit', 'CommentController@edit')->middleware('auth');
        Route::put('{id}/update', 'CommentController@update')->middleware('auth');
        Route::delete('{id}/delete', 'CommentController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'group'],function (){
        Route::get('/', 'GroupController@index')->middleware('auth');
        Route::get('/create', 'GroupController@create')->middleware('auth');
        Route::post('/save', 'GroupController@store')->middleware('auth');
        Route::get('{id}/show', 'GroupController@show')->middleware('auth');
        Route::get('{id}/edit', 'GroupController@edit')->middleware('auth');
        Route::put('{id}/update', 'GroupController@update')->middleware('auth');
        Route::delete('{id}/delete', 'GroupController@destroy')->middleware('auth');
    });
    Route::group(['prefix'=>'list_to_do'],function (){
        Route::get('/', 'ListToDoController@index')->middleware('auth');
        Route::get('/create', 'ListToDoController@create')->middleware('auth');
        Route::post('/save', 'ListToDoController@store')->middleware('auth');
        Route::get('{id}/show', 'ListToDoController@show')->middleware('auth');
        Route::get('{id}/edit', 'ListToDoController@edit')->middleware('auth');
        Route::put('{id}/update', 'ListToDoController@update')->middleware('auth');
        Route::delete('{id}/delete', 'ListToDoController@destroy')->middleware('auth');
    });
//    Route::group(['prefix'=>'message'],function (){
//        Route::get('/', 'MessageController@index')->middleware('auth');
//        Route::get('/create', 'MessageController@create')->middleware('auth');
//        Route::post('/save', 'MessageController@store')->middleware('auth');
//        Route::get('{id}/show', 'MessageController@show')->middleware('auth');
//        Route::get('{id}/edit', 'MessageController@edit')->middleware('auth');
//        Route::put('{id}/update', 'MessageController@update')->middleware('auth');
//        Route::delete('{id}/delete', 'MessageController@destroy')->middleware('auth');
//    });
//    Route::group(['prefix'=>'notification'],function (){
//        Route::get('/', 'NotificationController@index')->middleware('auth');
//        Route::get('/create', 'NotificationController@create')->middleware('auth');
//        Route::post('/save', 'NotificationController@store')->middleware('auth');
//        Route::get('{id}/show', 'NotificationController@show')->middleware('auth');
//        Route::get('{id}/edit', 'NotificationController@edit')->middleware('auth');
//        Route::put('{id}/update', 'NotificationController@update')->middleware('auth');
//        Route::delete('{id}/delete', 'NotificationController@destroy')->middleware('auth');
//    });
    Route::group(['prefix'=>'log_activity'],function (){
        Route::get('/', 'LogActivityController@index')->middleware('auth');
        Route::get('/create', 'LogActivityController@create')->middleware('auth');
        Route::post('/save', 'LogActivityController@store')->middleware('auth');
        Route::get('{id}/show', 'LogActivityController@show')->middleware('auth');
        Route::get('{id}/edit', 'LogActivityController@edit')->middleware('auth');
        Route::put('{id}/update', 'LogActivityController@update')->middleware('auth');
        Route::delete('{id}/delete', 'LogActivityController@destroy')->middleware('auth');
    });
});