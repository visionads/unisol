<?php

class LibFacultyController extends \BaseController {

    function __construct() {
        $this->beforeFilter('', array('except' => array('')));
    }

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    public function index()
	{
        if($this->isPostRequest()) {

            $lib_book_category_id = Input::get('lib_book_category_id');
            $lib_book_author_id = Input::get('lib_book_author_id');
            $lib_book_publisher_id = Input::get('lib_book_publisher_id');
           /*$lib_book_id = Input::get('title');*/

            $model = LibBook::with('relLibBookCategory','relLibBookAuthor','relLibBookPublisher');

            if (isset($lib_book_category_id) && !empty($lib_book_category_id)) $model->where('lib_books.lib_book_category_id', '=', $lib_book_category_id);
            if (isset($lib_book_author_id) && !empty($lib_book_author_id)) $model ->where('lib_books.lib_book_author_id', '=', $lib_book_author_id);
            if (isset($lib_book_publisher_id) && !empty($lib_book_publisher_id)) $model->where('lib_books.lib_book_publisher_id', '=', $lib_book_publisher_id);
            $model = $model->get();
           //print_r($model);exit;
        }else{
            $model = LibBook::with('relLibBookCategory','relLibBookAuthor','relLibBookPublisher')->latest('id')->get();
        }
            $lib_book_category_id = array('' => 'Select Category ') + LibBookCategory::lists('title', 'id');
            $lib_book_author_id = array('' => 'Select Author ') + LibBookAuthor::lists('name', 'id');
            $lib_book_publisher_id = array('' => 'Select Publisher ') + LibBookPublisher::lists('name', 'id');
            /*$lib_book_id = array('' => 'Select Book ') + LibBook::lists('title', 'id');*/

        return View::make('library::faculty.index',compact('lib_book_category_id','lib_book_author_id','lib_book_publisher_id','lib_book_id','model'));
	}

	public function addBookToCart($id)
	{
        if($id) {
            $model = LibBook::with('relLibBookCategory', 'relLibBookAuthor', 'relLibBookPublisher')->where('id', '=', $id)->first();
        }
        return View::make('library::faculty.add_book',compact('model','number'));
	}
    public function getBookTransaction(){

        $data = Input::all();
        $model = new LibBookTransaction();
//            $model->exm_exam_list_id = Input::get('exm_exam_list_id');
//            $model->course_conduct_id = Input::get('course_conduct_id');

        if($model->validate($data)) {
            DB::beginTransaction();
            try {
                $model->create($data);
                DB::commit();
                Session::flash('message', " Successfully Added  ");
            }
            catch ( Exception $e ){
                DB::rollback();
                Session::flash('danger', "Examination not added.Invalid Request !");
            }
            return Redirect::back();
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()
                ->with('errors', 'invalid');
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
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
