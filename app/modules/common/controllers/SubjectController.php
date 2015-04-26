<?php

class SubjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function create()
	{
		//
	}

	public function save()
	{
		$token = csrf_token();
		$rules = array(
			'department_id' => 'Required',
			'title' => 'Required|Min: 3',
			'description' => 'Required|min:3'
		);
		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails())
		{
			return Redirect::to('common/subject/')->withErrors($validator)->withInput();
		}
		else
		{
			if($token == Input::get('_token'))
			{
                DB::beginTransaction();
                try{
                    $data = new Subject;
                    $data->department_id = Input::get('department_id');
                    $data->title = Input::get('title');
                    $name = $data->title;
                    $data->description = Input::get('description');
                    $data->save();

                    DB::commit();
                    Session::flash('message', "$name Subject Added");
                }
                catch ( Exception $e ){
                    //If there are any exceptions, rollback the transaction
                    DB::rollback();
                    Session::flash('danger', " $name Subject is not added.Invalid Request !");
                }
                return Redirect::to('common/subject/');
			}
			else
			{
				Session::flash('message', 'Token Mismatched');
				return Redirect::to('common/subject/');
			}
		}
	}
	public function index()
	{
		$title = 'All Subject List';
		$search_text =trim(Input::get('search_text'));
		$department= array('' => 'Select department') + Department::lists('title', 'id');
		//Input::flash();
		$q = Subject::query();
		if (!empty($search_text))
		{
			$q->where(function($query) use ($search_text)
			{
				$query->where('department_id', 'LIKE', '%'.$search_text.'%');
				$query->orWhere('title', 'LIKE', '%'.$search_text.'%');
				$query->orWhere('description', 'LIKE', '%'.$search_text.'%');

			});
		}
		$datas = $q->orderBy('id', 'DESC')->paginate(10);
		return View::make('common::subject.index', compact('title', 'datas', 'department'));
	}

	public function batchdelete()
	{
		try {
			$data= Subject::destroy(Request::get('id'));
			if($data->delete())
			{
				Session::flash('danger', "Subject Deleted successfully");
				return Redirect::to('common/subject/');
			}
		}
		catch
		(exception $ex){
			return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
		}

	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function edit($id)
	{
		$department= array('' => 'Select department') + Department::lists('title', 'id');
		$dep_data = Subject::find($id);
		return View::make('common::subject.edit', compact('dep_data', 'department'));
	}

	public function update($id)
	{
		$token = csrf_token();
		$rules = array(
			'department_id' => 'Required',
			'title' => 'Required|Min: 3',
			'description' => 'Required|min:3'
		);
		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails())
		{
			return Redirect::to('common/subject/')->withErrors($validator)->withInput();
		}
		else
		{
			if($token == Input::get('_token'))
			{
                DB::beginTransaction();
                try{
                    $data = Subject::find($id);
                    $data->department_id = Input::get('department_id');
                    $data->title = Input::get('title');
                    $name = $data->title;
                    $data->description = Input::get('description');
                    $data->save();

                    DB::commit();
                    Session::flash('message', "$name Subject Updated");
                }
                catch ( Exception $e ){
                    //If there are any exceptions, rollback the transaction
                    DB::rollback();
                    Session::flash('danger', " $name Subject is not added.Invalid Request !");
                }
                return Redirect::to('common/subject/');
			}
			else
			{
				Session::flash('message', 'Token Mismatched');
				return Redirect::to('common/subject/');
			}
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$subject = Subject::find($id);
		return View::make('common::subject.show')->with('subject',$subject);
	}

	public function delete($id)
	{
		try {
			$data= Subject::find($id);
			$name = $data->title;
			if($data->delete())
			{
				Session::flash('message', "$name Subject Deleted");
				return Redirect::to('common/subject/');
			}
		}
		catch
		(exception $ex){
			return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
