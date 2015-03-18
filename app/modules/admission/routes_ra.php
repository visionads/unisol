<?php
/*
 * Created by PhpStorm.
 * User: Ratna
 * Date: 18/3/2015
 * Time: 10:30 AM
 */

Route::any('admission/amw/degree-course/{id}', [
    'as' => 'admission.amw.degree_courses',
    'uses' => 'AdmAmwController@degree_courses_index'
]);

Route::post('admission/amw/degree-courses/save',
    'AdmAmwController@degree_courses_save'
);

Route::get('admission/amw/degree-courses/delete/{id}',
    'AdmAmwController@degree_courses_delete'
);


