<?php

class AcmFacultyController extends \BaseController {


    function __construct() {
        $this->beforeFilter('auth', array('except' => array('index', 'show')));
    }


	public function index()
	{
        $mcq = "M";
        return View::make('academic::test.test', compact('mcq'));
	}



	public function create()
	{
		echo "Create";
	}



	public function store()
	{
		//
	}


	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}


	public function destroy($id)
	{
		//
	}


}
