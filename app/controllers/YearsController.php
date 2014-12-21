<?php

class YearsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function Index()
	{
		return View::make('years.index')->with('title','Create Years');
	}


	/**
	 * Show the form for creating a new resource.
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
				'title' => 'Required|Min: 3',
			    'description' => 'Required|min:3'
			);
		$validator = Validator::make(Input::all(), $rules);

		
			if($validator->fails())
			{				
				return Redirect::to('years/show')->withErrors($validator)->withInput()->with('title', 'Create Subject');
			}
			else
			{
				if($token == Input::get('_token'))
					{
							$data = new Years;
							$data->title = Input::get('title');
							$data->description = Input::get('description');
							$data->save();
							Session::flash('message', "Years added successfully");
						    return Redirect::to('years/show')->with('title', 'Years List');
					}
					else
					{
						Session::flash('message', 'Token Mismatched');
						return Redirect::to('years/show')->with('title', 'Years List');
					}
			}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	
	public function store()
	{
		//
	}

	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show()
	{
		$data= Years::orderBy('id', 'DESC')->paginate(5);
		return View::make('years.index')->with('datas',$data)->with('title','All Years list');
	}

	public function show_one($id)
	{
		 $years = Years::find($id);
		 return View::make('years.show')->with('years',$years);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
    {
    $years = Years::find($id);
    return View::make('years.edit')->with('years',$years);
    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$token = csrf_token();
		
		$rules = array(
				
				'title' => 'Required|Min: 3',
			    'description' => 'Required|min:3'
			);
		$validator = Validator::make(Input::all(), $rules);

		
			if($validator->fails())
			{				
				return Redirect::to('years/show')->withErrors($validator)->withInput()->with('title', 'Create Subject');
			}
			else
			{
				if($token == Input::get('_token'))
					{
							$data = new Years;
							$data->title = Input::get('title');
							$data->description = Input::get('description');
							$data->save();
							Session::flash('message', "Years Updated successfully");
						return Redirect::to('years/show')->with('title', 'Years List');
					}
					else
					{
						Session::flash('message', 'Token Mismatched');
						return Redirect::to('years/show')->with('title', 'Years List');
					}
			}
	}

	public function delete($id)
	{
		$data= Years::find($id);
		if($data->delete())
		{
		 return Redirect::to('years/show')->with('title','All Years List');
		}
	}

	 public function batchdelete()
     {

     	Years::destroy(Request::get('id'));
        return Redirect::to('years/show')->with('title','All Subject List');

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
