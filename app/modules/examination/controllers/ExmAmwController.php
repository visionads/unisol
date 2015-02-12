<?php

class ExmAmwController extends \BaseController {

    function __construct() {
        $this->beforeFilter('exmAmw', array('except' => array('')));
    }

	public function index()
	{
        $data = ExmQuestion::with('relCourseManagement', 'relCourseManagement.relYear',
                                  'relCourseManagement.relSemester','relCourseManagement.relCourse.relSubject.relDepartment')
                                  ->get();
        return View::make('examination::amw.prepare_question_paper.index')->with('datas',$data);
	}
	public function viewQuestion($id)
	{
        $view_question_amw = ExmQuestion::find($id);

        return View::make('examination::amw.prepare_question_paper.viewQuestion')->with('viewPrepareQuestionPaperAmw', $view_question_amw);
	}
    public function assignTo()
    {
        echo "Not Done Yet";
    }
    public function createQuestionPaper()
    {
        return View::make('examination::amw.prepare_question_paper.create')->compact('crt_question_ppr');
        //ok
    }
    public function storeQuestionPaper()
    {
        $data = Input::all();

        $prepare_question_paper = new ExmQuestion();

        if ($prepare_question_paper->validate($data))
        {
            // success code
            $prepare_question_paper->exm_exam_list_id = Input::get('exm_exam_list_id');

//            print_r($prepare_question_paper->exm_exam_list_id);exit;

            $prepare_question_paper->course_management_id = '1';
            $prepare_question_paper->examiner_faculty_user_id = '1';
            $prepare_question_paper->title = Input::get('title');
            $prepare_question_paper->deadline = Input::get('deadline');
            $prepare_question_paper->total_marks = Input::get('total_marks');
            $prepare_question_paper->created_by = Auth::user()->id;
            $prepare_question_paper->updated_by = Auth::user()->id;
            $prepare_question_paper->save();

            // redirect
            Session::flash('message', 'Successfully Added!');
            return Redirect::to('examination/amw/index');
        }
        else
        {
            // failure, get errors
            $errors = $prepare_question_paper->errors();
            Session::flash('errors', $errors);

            return Redirect::to('examination/amw/create');
        }
        //ok
    }
    public function editQuestionPaper($id)
    {
        $prepare_question_paper = ExmQuestion::find($id);

        // Show the edit employee form.
        return View::make('examination::amw.prepare_question_paper.editQuestionPaper')->with('edit_AmwQuestionPaper',$prepare_question_paper);
        //ok
    }
    public function updateQuestionPaper($id)
    {
        // get the POST data
        $data = Input::all($id);
        // create a new model instance
        $prepare_question_paper = new ExmQuestion();
        // attempt validation
        if ($prepare_question_paper->validate($data))
        {
            $prepare_question_paper = ExmQuestion::find($id);
            $prepare_question_paper->exm_exam_list_id = Input::get('exm_exam_list_id');
            $prepare_question_paper->title = Input::get('title');
            $prepare_question_paper->deadline = Input::get('deadline');
            $prepare_question_paper->total_marks = Input::get('total_marks');
            $prepare_question_paper->created_by = Auth::user()->id;
            $prepare_question_paper->updated_by = Auth::user()->id;
            $prepare_question_paper->save();
            // redirect
            Session::flash('message', 'Successfully Added!');
            return Redirect::to('examination/amw/index');
        }
        else
        {
            // failure, get errors
            $errors = $prepare_question_paper->errors();
            Session::flash('errors', $errors);

            return Redirect::to('examination/amw/editQuestionPaper');
        }
        //ok
    }
    public function questionList()
    {
        $question_list_amw = ExmQuestionItems::orderBy('id', 'DESC')->paginate(15);
        return View::make('examination::amw.prepare_question_paper.questionList')->with('QuestionListAmw',$question_list_amw);
    }
    public function viewQuestionItems($id)
    {
        $amw_ViewQuestionItems = DB::table('exm_question_items')
            ->where('id', $id)
            ->first();

        $options = DB::table('exm_question_opt_ans')
            ->where('exm_question_items_id', $amw_ViewQuestionItems->id)
            ->get();

        return View::make('examination::amw.prepare_question_paper.viewQuestionItems', compact('amw_ViewQuestionItems', 'options'));

    }
    public function destroy($id)
    {
        try {
            ExmQuestion::find($id)->delete();
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch(exception $ex){
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');

        }
        //ok
    }
    public function batchDelete()
    {
        try {
            ExmQuestion::destroy(Request::get('id'));
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch
        (exception $ex){
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');

        }
        //ok
    }
    public function batchItemsDelete()
    {
        try {
            ExmQuestionItems::destroy(Request::get('id'));
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch
        (exception $ex){
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');

        }
        //ok
    }


}
