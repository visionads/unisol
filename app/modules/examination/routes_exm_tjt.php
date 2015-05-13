<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('amw/exam-list',[
    'as' =>'amw.exam-list',
    'uses' => 'ExmAmwController@examList'
]);

Route::any('examination/amw/create-exam',[
    'as' =>'examination.amw.create-exam',
    'uses' => 'ExmAmwController@createExamination'
]);

Route::any('amw/store-exam',[
    'as' =>'amw.store-exam',
    'uses' => 'ExmAmwController@storeExamination'
]);

Route::any('amw/drop-down-courses',[
    'as' =>'amw.drop-down-courses',
    'uses' => 'ExmAmwController@createAjaxCourseList'
]);

Route::any('amw/view-exam-data/{id}', [
    'as' => 'amw.view-exam-data',
    'uses' => 'ExmAmwController@viewExamination'
]);

Route::any('amw/edit-exam-data/{id}', [
    'as' => 'amw.edit-exam-data',
    'uses' => 'ExmAmwController@editExamination'
]);
Route::any('amw/update-exam-data/{id}', [
    'as' => 'amw.update-exam-data',
    'uses' => 'ExmAmwController@updateExamination'
]);

Route::any('examination/amw/delete-exam-data/{id}', [
    'as' => 'examination.amw.delete-exam-data',
    'uses' => 'ExmAmwController@deleteExamination'
]);




