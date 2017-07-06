<?php
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 06/07/2017
 * Time: 8:47
 */

Route::group(['prefix'=>'data'],function (){
    Route::group(['prefix'=>'user'],function (){
        Route::get('/', 'UserController@index');
        Route::get('/create', 'UserController@create');
        Route::post('/save', 'UserController@store');
        Route::get('{id}/show', 'UserController@show');
        Route::get('{id}/edit', 'UserController@edit');
        Route::put('{id}/update', 'UserController@update');
        Route::delete('{id}/delete', 'UserController@destroy');
    });
    Route::group(['prefix'=>'profile'],function (){
        Route::get('/', 'ProfileController@index');
        Route::get('/create', 'ProfileController@create');
        Route::post('/save', 'ProfileController@store');
        Route::get('{id}/show', 'ProfileController@show');
        Route::get('{id}/edit', 'ProfileController@edit');
        Route::put('{id}/update', 'ProfileController@update');
        Route::delete('{id}/delete', 'ProfileController@destroy');
    });
    Route::group(['prefix'=>'user_activity'],function (){
        Route::get('/', 'UserActivityController@index');
        Route::get('/create', 'UserActivityController@create');
        Route::post('/save', 'UserActivityController@store');
        Route::get('{id}/show', 'UserActivityController@show');
        Route::get('{id}/edit', 'UserActivityController@edit');
        Route::put('{id}/update', 'UserActivityController@update');
        Route::delete('{id}/delete', 'UserActivityController@destroy');
    });
    Route::group(['prefix'=>'activity'],function (){
        Route::get('/', 'ActivityController@index');
        Route::get('/create', 'ActivityController@create');
        Route::post('/save', 'ActivityController@store');
        Route::get('{id}/show', 'ActivityController@show');
        Route::get('{id}/edit', 'ActivityController@edit');
        Route::put('{id}/update', 'ActivityController@update');
        Route::delete('{id}/delete', 'ActivityController@destroy');
    });
    Route::group(['prefix'=>'archive'],function (){
        Route::get('/', 'ArchiveController@index');
        Route::get('/create', 'ArchiveController@create');
        Route::post('/save', 'ArchiveController@store');
        Route::get('{id}/show', 'ArchiveController@show');
        Route::get('{id}/edit', 'ArchiveController@edit');
        Route::put('{id}/update', 'ArchiveController@update');
        Route::delete('{id}/delete', 'ArchiveController@destroy');
    });
    Route::group(['prefix'=>'attachment_activity'],function (){
        Route::get('/', 'AttchmentActivityController@index');
        Route::get('/create', 'AttchmentActivityController@create');
        Route::post('/save', 'AttchmentActivityController@store');
        Route::get('{id}/show', 'AttchmentActivityController@show');
        Route::get('{id}/edit', 'AttchmentActivityController@edit');
        Route::put('{id}/update', 'AttchmentActivityController@update');
        Route::delete('{id}/delete', 'AttchmentActivityController@destroy');
    });
    Route::group(['prefix'=>'attachment_comment'],function (){
        Route::get('/', 'AttachmentCommentController@index');
        Route::get('/create', 'AttachmentCommentController@create');
        Route::post('/save', 'AttachmentCommentController@store');
        Route::get('{id}/show', 'AttachmentCommentController@show');
        Route::get('{id}/edit', 'AttachmentCommentController@edit');
        Route::put('{id}/update', 'AttachmentCommentController@update');
        Route::delete('{id}/delete', 'AttachmentCommentController@destroy');
    });
    Route::group(['prefix'=>'attachment_list_to_do'],function (){
        Route::get('/', 'AttachmentListToDoController@index');
        Route::get('/create', 'AttachmentListToDoController@create');
        Route::post('/save', 'AttachmentListToDoController@store');
        Route::get('{id}/show', 'AttachmentListToDoController@show');
        Route::get('{id}/edit', 'AttachmentListToDoController@edit');
        Route::put('{id}/update', 'AttachmentListToDoController@update');
        Route::delete('{id}/delete', 'AttachmentListToDoController@destroy');
    });
    Route::group(['prefix'=>'comment'],function (){
        Route::get('/', 'CommentController@index');
        Route::get('/create', 'CommentController@create');
        Route::post('/save', 'CommentController@store');
        Route::get('{id}/show', 'CommentController@show');
        Route::get('{id}/edit', 'CommentController@edit');
        Route::put('{id}/update', 'CommentController@update');
        Route::delete('{id}/delete', 'CommentController@destroy');
    });
    Route::group(['prefix'=>'group'],function (){
        Route::get('/', 'CommentController@index');
        Route::get('/create', 'CommentController@create');
        Route::post('/save', 'CommentController@store');
        Route::get('{id}/show', 'CommentController@show');
        Route::get('{id}/edit', 'CommentController@edit');
        Route::put('{id}/update', 'CommentController@update');
        Route::delete('{id}/delete', 'CommentController@destroy');
    });
    Route::group(['prefix'=>'list_to_do'],function (){
        Route::get('/', 'ListToDoController@index');
        Route::get('/create', 'ListToDoController@create');
        Route::post('/save', 'ListToDoController@store');
        Route::get('{id}/show', 'ListToDoController@show');
        Route::get('{id}/edit', 'ListToDoController@edit');
        Route::put('{id}/update', 'ListToDoController@update');
        Route::delete('{id}/delete', 'ListToDoController@destroy');
    });
    Route::group(['prefix'=>'message'],function (){
        Route::get('/', 'MessageController@index');
        Route::get('/create', 'MessageController@create');
        Route::post('/save', 'MessageController@store');
        Route::get('{id}/show', 'MessageController@show');
        Route::get('{id}/edit', 'MessageController@edit');
        Route::put('{id}/update', 'MessageController@update');
        Route::delete('{id}/delete', 'MessageController@destroy');
    });
    Route::group(['prefix'=>'notification'],function (){
        Route::get('/', 'NotificationController@index');
        Route::get('/create', 'NotificationController@create');
        Route::post('/save', 'NotificationController@store');
        Route::get('{id}/show', 'NotificationController@show');
        Route::get('{id}/edit', 'NotificationController@edit');
        Route::put('{id}/update', 'NotificationController@update');
        Route::delete('{id}/delete', 'NotificationController@destroy');
    });
    Route::group(['prefix'=>'log_activity'],function (){
        Route::get('/', 'LogActivityController@index');
        Route::get('/create', 'LogActivityController@create');
        Route::post('/save', 'LogActivityController@store');
        Route::get('{id}/show', 'LogActivityController@show');
        Route::get('{id}/edit', 'LogActivityController@edit');
        Route::put('{id}/update', 'LogActivityController@update');
        Route::delete('{id}/delete', 'LogActivityController@destroy');
    });
});