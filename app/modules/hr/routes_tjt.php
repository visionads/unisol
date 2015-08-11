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
Route::any('test',[
    'as' =>'test',
    'uses' => 'HrAttendanceController@test'
]);
//Hr Attendance

Route::any('attendance',[
    'as' =>'attendance',
    'uses' => 'HrAttendanceController@index'
]);

Route::any('attendance/store',[
    'as' =>'attendance.store',
    'uses' => 'HrAttendanceController@storeAttendance'
]);

Route::any('attendance/show/{id}',[
    'as' =>'attendance.show',
    'uses' => 'HrAttendanceController@showAttendance'
]);

Route::any('attendance/edit/{id}',[
    'as' =>'attendance.edit',
    'uses' => 'HrAttendanceController@editAttendance'
]);

Route::any('attendance/update/{id}',[
    'as' =>'attendance.update',
    'uses' => 'HrAttendanceController@updateAttendance'
]);

Route::any('attendance/delete/{id}',[
    'as' =>'attendance.delete',
    'uses' => 'HrAttendanceController@deleteAttendance'
]);

Route::any('attendance/batch-delete',[
    'as' =>'attendance.batch-delete',
    'uses' => 'HrAttendanceController@batchDelete'
]);


//Work Week

Route::any('work-week',[
    'as' =>'work-week',
    'uses' => 'HrWorkWeekController@index'
]);

Route::any('work-week/store',[
    'as' =>'work-week.store',
    'uses' => 'HrWorkWeekController@store'
]);

Route::any('work-week/show/{id}',[
    'as' =>'work-week.show',
    'uses' => 'HrWorkWeekController@showWorkWeek'
]);

Route::any('work-week/edit/{id}',[
    'as' =>'work-week.edit',
    'uses' => 'HrWorkWeekController@editWorkWeek'
]);

Route::any('work-week/update/{id}',[
    'as' =>'work-week.update',
    'uses' => 'HrWorkWeekController@updateWorkWeek'
]);

Route::any('work-week/delete/{id}',[
    'as' =>'work-week.delete',
    'uses' => 'HrWorkWeekController@deleteWorkWeek'
]);

Route::any('work-week/batch-delete',[
    'as' =>'work-week.batch-delete',
    'uses' => 'HrWorkWeekController@batchDelete'
]);


// HR leave

Route::any('leave',[
    'as' =>'leave',
    'uses' => 'HrLeaveController@index'
]);

Route::any('leave/show/{id}',[
    'as' =>'leave.show',
    'uses' => 'HrLeaveController@showLeave'
]);

Route::any('leave/batch-delete',[
    'as' =>'leave.batch-delete',
    'uses' => 'HrLeaveController@batchDelete'
]);

Route::any('leave/view-comments/{id}',[
   'as' =>'leave.view-comments',
    'uses' => 'HrLeaveController@viewComments'
]);

Route::any('leave/store-comments',[
    'as' =>'store.leave.comments',
    'uses' => 'HrLeaveController@storeComments'
]);

//hr_employee leave
Route::any('employee/leave',[
    'as' =>'employee.leave',
    'uses' => 'EmployeeController@employeeIndex'
]);

Route::any('leave/store',[
    'as' =>'leave.store',
    'uses' => 'EmployeeController@storeHrLeave'
]);

Route::any('leave/show/{id}',[
    'as' =>'leave.show',
    'uses' => 'EmployeeController@showLeave'
]);

Route::any('leave/edit/{id}',[
    'as' =>'leave.edit',
    'uses' => 'EmployeeController@editLeave'
]);

Route::any('leave/update/{id}',[
    'as' =>'leave.update',
    'uses' => 'EmployeeController@updateLeave'
]);

Route::any('leave/delete/{id}',[
    'as' =>'leave.delete',
    'uses' => 'EmployeeController@deleteLeave'
]);

Route::any('leave/comments/{id}',[
    'as' =>'leave.comments',
    'uses' => 'EmployeeController@viewComments'
]);

Route::any('update/leave-comments',[
    'as' =>'update.leave.comments',
    'uses' => 'EmployeeController@updateComments'
]);
//Leave Type

Route::any('leave-type',[
    'as' =>'leave-type',
    'uses' => 'HrLeaveTypeController@index'
]);

Route::any('leave-type/store',[
    'as' =>'leave-type.store',
    'uses' => 'HrLeaveTypeController@storeLeaveType'
]);

Route::any('leave-type/show/{id}',[
    'as' =>'leave-type.show',
    'uses' => 'HrLeaveTypeController@showLeaveType'
]);

Route::any('leave-type/edit/{id}',[
    'as' =>'leave-type.edit',
    'uses' => 'HrLeaveTypeController@editLeaveType'
]);

Route::any('leave-type/update/{id}',[
    'as' =>'leave-type.update',
    'uses' => 'HrLeaveTypeController@updateLeaveType'
]);

Route::any('leave-type/delete',[
    'as' =>'leave-type.delete',
    'uses' => 'HrLeaveTypeController@ajaxDelete'
]);

Route::any('leave-type/batch-delete',[
    'as' =>'leave-type.batch-delete',
    'uses' => 'HrLeaveTypeController@batchDelete'
]);



//Provident Fund

Route::any('provident-fund',[
    'as' =>'provident-fund',
    'uses' => 'HrProvidentFundController@index'
]);

Route::any('provident-fund/store',[
    'as' =>'provident-fund.store',
    'uses' => 'HrProvidentFundController@storePvdFund'
]);

Route::any('provident-fund/show/{id}',[
    'as' =>'provident-fund.show',
    'uses' => 'HrProvidentFundController@showPvdFund'
]);

Route::any('provident-fund/edit/{id}',[
    'as' =>'provident-fund.edit',
    'uses' => 'HrProvidentFundController@editPvdFund'
]);

Route::any('provident-fund/update/{id}',[
    'as' =>'provident-fund.update',
    'uses' => 'HrProvidentFundController@updatePvdFund'
]);

Route::any('provident-fund/delete/{id}',[
    'as' =>'provident-fund.delete',
    'uses' => 'HrProvidentFundController@deletePvdFund'
]);

Route::any('provident-fund/batch-delete',[
    'as' =>'provident-fund.batch-delete',
    'uses' => 'HrProvidentFundController@batchDelete'
]);

//Hr Provident Fund Config

Route::any('provident-fund-config',[
    'as' =>'provident-fund-config',
    'uses' => 'HrProvidentFundConfigController@index'
]);

Route::any('provident-fund-config/store',[
    'as' =>'provident-fund-config.store',
    'uses' => 'HrProvidentFundConfigController@store'
]);

Route::any('provident-fund-config/delete',[
    'as' =>'provident-fund-config.delete',
    'uses' => 'HrProvidentFundConfigController@ajaxDelete'
]);

Route::any('update',[
    'as' =>'update',
    'uses' => 'HrProvidentFundConfigController@updatePvc'
]);


