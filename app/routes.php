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

//Route::get('/','HomeController@index');


Route::get('/hellow','TestController@index');



/*
==================================================================
Selim
==================================================================
*/

include("routes_sr.php");


/*
==================================================================
Shafi
==================================================================
*/

include("routes_sh.php");


/*
==================================================================
Ratna
==================================================================
*/

include("routes_ra.php");


/*
==================================================================
Tanin
==================================================================
*/

include("routes_tj.php");

