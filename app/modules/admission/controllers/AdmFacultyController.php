<?php

class AdmFacultyController extends \BaseController {

    function __construct() {
        $this->beforeFilter('admFaculty', array('except' => array('index')));
    }

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

// Admission : Admission Test starts here...........................................................


// Admission Test
    //ok
	public function indexAdmExaminer()
	{
        $index_adm_examiner = AdmExaminer::with('relBatch','relBatch.relDegree',
            'relBatch.relDegree.relDepartment','relBatch.relYear','relBatch.relSemester')
//            ->where('user_id', '=', Auth::user()->get()->id)
            ->get();

        $year_id = array('' => 'Select Year ') + Year::lists('title', 'id');
        $semester_id = array('' => 'Select Semester ') + Semester::lists('title', 'id');
        return View::make('admission::faculty.admission_test.index',
            compact('index_adm_examiner','year_id','semester_id'));

	}

    //ok
    public function changeStatustoDenyByFacultyAdmTest($id){
        $model = AdmExaminer::findOrFail($id);
        $model->status = 'Deny';
        if($model->save()){
            Session::flash('danger', 'Deny or Revoked! ');
            return Redirect::back();
        }

    }

    //ok
    public function changeStatusToAcceptedByFacultyAdmTest($id){
        $model = AdmExaminer::findOrFail($id);
        $model->status = 'Accepted';
        if($model->save()){
            Session::flash('message', 'Requested Accepted! ');
            return Redirect::back();
        }

    }

    //ok
    public function viewAdmTest($id)
    {
        $view_adm_test = AdmExaminer::find($id);

        $dept_name = AdmExaminer::with('relBatch','relBatch.relDegree')->first()->relBatch->relDegree->relDepartment->title;

        $view_adm_test_comments = AdmExaminerComments::find($id);

        return View::make('admission::faculty.admission_test.view_admtest',
            compact('view_adm_test','dept_name','view_adm_test_comments'));

    }

    //ok
    public function searchAdmExaminer()
    {
        $year_id = Input::get('year_id');
        $semester_id = Input::get('semester_id');

        $search_index_adm_examiner = AdmExaminer::with(['relBatch' => function($query) use($year_id, $semester_id) {
                    $query->where('year_id', '=', $year_id);
                    $query->where('semester_id', '=', $semester_id);
                }],'relBatch.relDegree','relBatch.relDegree.relDepartment',
                   'relBatch.relYear','relBatch.relSemester')
                ->get();

        $year_id = array('' => 'Select Year ') + Year::lists('title', 'id');
        $semester_id = array('' => 'Select Semester ') + Semester::lists('title', 'id');

        return View::make('admission::faculty.admission_test._search_adm_examiner_index',
            compact('search_index_adm_examiner','year_id','semester_id'));

    }
    //ok
    public function batchDelete()
    {
        try {
            AdmExaminer::destroy(Request::get('id'));
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch(exception $ex) {
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
        }
    }


    //ok
    public function admTestQuestionPaper($year_id, $semester_id, $batch_id )
    {
        $admtest_question_paper = AdmQuestion::latest('id')
           ->where('s_faculty_user_id' ,'=', Auth::user()->get()->id)
           ->get();

        // user id nie ektu jhamela ace.

        $degree_id = Batch::where('id' ,'=', $batch_id )
            ->where('semester_id' ,'=', $semester_id)
            ->where('year_id' ,'=', $year_id)
            ->first()->degree_id;

        $degree_data = Degree::with('relDepartment')
            ->where('id','=', $degree_id)
            ->first();

        return View::make('admission::faculty.question_papers.question_papers',
            compact('admtest_question_paper','degree_id','degree_data','semester_id','year_id'));
    }

    //ok
    public function viewQuestionPaper($id)
    {
        $view_adm_qp = AdmQuestion::find($id);

        return View::make('admission::faculty.question_papers.view_question_paper',
            compact('view_adm_qp'));

    }

    //ok
    public function viewQuestionsItems($id)
    {
        $view_adm_qp_items = AdmQuestionItems::where('adm_question_id', '=', $id)->get();

        return View::make('admission::faculty.question_papers.view_qp_items',
            compact('view_adm_qp_items'));

    }

//fct: add question items
    //ok
    public function addQuestionItems($qid){
        $question_item = AdmQuestion::find($qid);

//        $total_marks = $this->totalMarks($qid);

        return View::make('admission::faculty.question_papers._add_question_item_form', compact('total_marks', 'question_item'));
    }

    //ok
    public function storeQuestionItems()
    {
        $data = Input::all();

        $faculty_admisison_store_question_items = new AdmQuestionItems();
        if ($faculty_admisison_store_question_items->validate($data))
        {
            $faculty_admisison_store_question_items->title = Input::get('title');
            $faculty_admisison_store_question_items->adm_question_id = Input::get('adm_question_id');
            $faculty_admisison_store_question_items->marks = Input::get('marks');

            if( strtolower(Input::get('mcq')) == 'mcq'){
                if( strtolower(Input::get('r_question_type')) == 'mcq_single'){
                    $faculty_admisison_store_question_items->question_type = 'radio';
                    if($faculty_admisison_store_question_items->save()) {
                        $adm_question_items_id = $faculty_admisison_store_question_items->id;
                        $opt_title = Input::get('option_title');
                        $opt_answer = Input::get('answer');

                        $i = 0;
                        foreach ($opt_title as $key => $value) {
                            //Re-declare model each time you want to save data as loop.
                            $adm_question_opt = new AdmQuestionOptAns();
                            $adm_question_opt->adm_question_items_id = $adm_question_items_id;
                            $adm_question_opt->title = $value;
                            $adm_question_opt->answer = 0;

//                            if (isset($opt_answer))
                            foreach ($opt_answer as $oa) {
                                if ($oa == $key)
                                    $adm_question_opt->answer = 1;
                            }
                            $adm_question_opt->save();
                            $i++;
                        }
                        echo "Option Data : Single Answer Saved!";
                    }else {
                        echo "NO";
                    }
                }else{
                    $faculty_admisison_store_question_items->question_type = 'checkbox';
                    if($faculty_admisison_store_question_items->save()){
                        $adm_question_items_id = $faculty_admisison_store_question_items->id;
                        $opt_title = Input::get('option_title');
                        $opt_answer = Input::get('answer');

                        $i = 0;
                        foreach($opt_title as $key => $value){
                            //Re-declare model each time you want to save data as loop.
                            $adm_question_opt = new AdmQuestionOptAns();
                            $adm_question_opt->adm_question_items_id = $adm_question_items_id;
                            $adm_question_opt->title = $value;
                            $adm_question_opt->answer = 0;

                            foreach($opt_answer as $oa){
                                if($oa == $key)
                                    $adm_question_opt->answer = 1;
                            }

                            $adm_question_opt->save();
                            $i++;


                        } /// saving last single data
                        echo "Option Data : Multiple Answer Saved!";
                    }else{
                        echo "NO";
                    }
                }
            }else{
                $faculty_admisison_store_question_items->question_type = 'text';
                if($faculty_admisison_store_question_items->save()){
                    echo "Save";
                }else{
                    echo "No";
                }
            }

            // redirect
            Session::flash('message', 'Successfully Added!');
            return Redirect::back();
        }
        else
        {
            // failure, get errors
            $errors = $faculty_admisison_store_question_items->errors();
            Session::flash('errors', $errors);

            return Redirect::back();
        }
    }

    //ok
    public function viewSpecificQuestionItems($id)
    {
        $faculty_ViewQuestionItems = AdmQuestionItems::where('id', $id)->first();

        $options = AdmQuestionOptAns::where('adm_question_items_id', $faculty_ViewQuestionItems->id)->get();

        return View::make('admission::faculty.question_papers.viewSpecificQuestionItems', compact('faculty_ViewQuestionItems', 'options'));

    }

    //ok
    public function editSpecificQuestionItems($id)
    {
        $faculty_editQuestionItems = AdmQuestionItems::where('id', $id)->first();

        $faculty_editQuestionOptions = AdmQuestionOptAns::where('adm_question_items_id', $faculty_editQuestionItems->id)->get();

        return View::make('admission::faculty.question_papers.editSpecificQuestionItems',
            compact('faculty_editQuestionItems', 'faculty_editQuestionOptions'));

    }

    //ok
    public function updateSpecificQuestionItems($id)
    {
//        echo "ok";exit;

        $data = Input::all($id);
        $faculty_adm_update_question_items = new AdmQuestionItems();
        if ($faculty_adm_update_question_items->validate($data))
        {

            $faculty_adm_update_question_items = AdmQuestionItems::find($id);
            $faculty_adm_update_question_items->title = Input::get('title');
            $faculty_adm_update_question_items->adm_question_id = Input::get('adm_question_id');
            $faculty_adm_update_question_items->marks = Input::get('marks');
            //print_r($faculty_store_question_items);exit;
            if( strtolower(Input::get('mcq')) == 'mcq'){

                if( strtolower(Input::get('r_c')) == 'mcq_single'){

                    $faculty_adm_update_question_items->question_type = 'radio';

                    if($faculty_adm_update_question_items->save()) {

                        $adm_question_items_id = Input::get('id');
                        $opt_title = Input::get('option_title');
                        $opt_answer = Input::get('answer');
                        $i = 0;
                        foreach ($opt_title as $key => $value) {

                            //Re-declare model each time you want to save data as loop.
                            $adm_question_opt = (isset($adm_question_items_id)) ? AdmQuestionOptAns::find($adm_question_items_id[$i]) : new AdmQuestionOptAns() ;
                            if(isset($adm_question_items_id) == null){
                                $adm_question_opt->adm_question_items_id = $faculty_adm_update_question_items->id;
                            }

                            #print_r($adm_question_items_id);exit;

                            $adm_question_opt->title = $value;
                            $adm_question_opt->answer = 0;

                            foreach ($opt_answer as $oa) {
                                if ($oa == $key)
                                    $adm_question_opt->answer = 1;
                            }

                            $adm_question_opt->save();
                            $i++;
                        }
                        echo "Option Data : Single Answer Saved!";
                    }else {
                        echo "NO";
                    }
                }else{
                    $faculty_adm_update_question_items->question_type = 'checkbox';


                    if($faculty_adm_update_question_items->save()){
                        $adm_question_items_id = Input::get('id');

                        #print_r($adm_question_items_id); exit;

                        $opt_title = Input::get('option_title');
                        $opt_answer = Input::get('answer');
                        $i = 0;
                        #print_r($opt_title);exit;
                        foreach($opt_title as $key => $value){
                            //Re-declare model each time you want to save data as loop.

                            $adm_question_opt = (isset($adm_question_items_id)) ? AdmQuestionOptAns::find($adm_question_items_id[$i]) : new AdmQuestionOptAns() ;

                            #print_r($adm_question_items_id); exit;

                            if(isset($adm_question_items_id) == null){
                                $adm_question_opt->adm_question_items_id = $faculty_adm_update_question_items->id;

                            }
                            $adm_question_opt->title = $value;
                            $adm_question_opt->answer = 0;

                            foreach ($opt_answer as $oa) {
                                if ($oa == $key)
                                    $adm_question_opt->answer = 1;
                            }

                            $adm_question_opt->save();
                            $i++;
                        }
                        echo "Option Data : Multiple Answer Saved!";
                    }else{
                        echo "NO";
                    }
                }
            }else {

                $faculty_adm_update_question_items->question_type = 'text';
                $faculty_adm_update_question_items->save();

                $adm_question_opt = new AdmQuestionOptAns();
                $adm_question_opt->destroy(Request::get('id'));

            }
            // redirect
            Session::flash('message', 'Successfully Updated!');
            return Redirect::back();
        }
        else
        {
            // failure, get errors
            $errors = $faculty_adm_update_question_items->errors();
            Session::flash('errors', $errors);
            return Redirect::back();
        }
    }

    //ok
    public function viewAssignQuestionPaper($q_id)
    {
        $assign_qp = AdmQuestion::findOrFail($q_id);

        $assign_qp_assign = AdmQuestionComments::where('adm_question_id', $q_id)->get();


        return View::make('admission::faculty.question_papers.assign_qp',
            compact('assign_qp','assign_qp_assign','q_id'));

    }

    //ok
    /**
     * @return mixed
     */
    public function commentAssignQuestionPaper()
    {
        $info = Input::all();
//        print_r(Input::get('adm_question_id'));exit;
        $model = new AdmQuestionComments();


        $model->adm_question_id = $info['adm_question_id'];
        $model->comment = $info['comment'];
        $model->commented_to = $info['commented_to'];
        $model->commented_by = Auth::user()->get()->id;

//        $user_name = User::FullName($model->commented_to);
        if($model->save()){
            Session::flash('message', 'Comments added');
            return Redirect::back();
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()->with('errors', 'invalid');
        }
    }

//ok
    /**
     * @param $adm_question_id
     * @return mixed
     */
    public function evaluateQuestions($adm_question_id)
    {
        $data = AdmQuestion::with('relBatchAdmtestSubject',
            'relBatchAdmtestSubject.relBatch','relBatchAdmtestSubject.relAdmtestSubject')
            ->where('id','=',$adm_question_id)->first();

        $evaluation_qp = AdmQuestionEvaluation::with('relBatchApplicant','relBatchApplicant.relApplicant')
            ->where('adm_question_id','=', $adm_question_id)
            ->latest('id')->groupBy('adm_question_id')
            ->select(DB::raw('SUM(marks) as ev_marks, id as id, batch_applicant_id, adm_question_id, adm_question_items_id'))
            ->get();
        //print_r($evaluation_qp);exit;

        return View::make('admission::faculty.question_papers.evaluate_question_paper',
            compact('evaluation_qp','data'));

    }

    //ok
    protected function totalMarks($adm_question_id){
        $result = DB::table('adm_question_evaluation')
            ->select(DB::raw('SUM(marks) as evaluated_total_marks'))
            ->where('adm_question_id', '=', $adm_question_id)
            ->first();
        return $result;
    }

    /**
     * @param $a_q_id : adm_question_id
     * @param $a_q_itm_id : adm_question_items_id
     * @param bool $no_q : number of question
     * @return mixed
     */
    //ok
    public function evaluateQuestionsItems($a_q_id , $no_q = false )
    {
            $all = AdmQuestionEvaluation::where('adm_question_id', $a_q_id)->get();
            foreach ($all as $ev_itm) {
                $ev_id [] = $ev_itm->id;
                $ev_q_item_id [] = $ev_itm->adm_question_items_id;
                $ev_marks [] = $ev_itm->marks;
            }
            $no_q = !empty($no_q) ? $no_q : 0;
            $total_question = count($all);
            $q_item_info = AdmQuestionItems::findOrFail($ev_q_item_id[$no_q]);
            $evaluation_id = $ev_id[$no_q];
            $evaluation_marks = $ev_marks[$no_q];

            $data_question = AdmQuestion::with('relBatchAdmtestSubject',
                'relBatchAdmtestSubject.relBatch', 'relBatchAdmtestSubject.relAdmtestSubject')
                ->where('id', '=', $a_q_id)->first();

            $evaluate_qp = AdmQuestionEvaluation::with('relBatchApplicant', 'relBatchApplicant.relApplicant',
                'relAdmQuestionItems', 'relAdmQuestionItems.relAdmQuestion')
                ->where('adm_question_id', '=', $a_q_id)
                ->latest('id')
                ->first();

            $total_marks = AdmQuestionEvaluation::where('adm_question_id','=', $a_q_id)
                ->latest('id')->groupBy('adm_question_id')
                ->select(DB::raw('SUM(marks) as ev_marks'))
                ->first();

            return View::make('admission::faculty.question_papers.evaluate-questions-items',
                compact('data_question', 'evaluate_qp', 'a_q_id', 'evaluation_id','evaluation_marks', 'eva_q_ans', 'b', 'total_question', 'no_q', 'q_item_info', 'total_marks'));
    }

    //ok
    public function storeEvaluatedQuestionItems()
    {
        $data = Input::all();
        $model = AdmQuestionEvaluation::find($data['id']);

        if($model->validate($data)){
            if($model->update($data)){
                Session::flash('message', 'Successfully Updates Information!');
                return Redirect::back();
            }
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()
                ->with('error', 'invalid');
        }
    }

    //ok
    public function reEvaluateQuestionsitems()
    {
        return View::make('admission::faculty.question_papers.re-evaluate-questions-items',
            compact(''));
    }

    //ok
    public function qpBatchDelete()
    {
        try {
            AdmQuestion::destroy(Request::get('id'));
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch(exception $ex) {
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
        }
    }

    //ok
    public function evaluationBatchDelete()
    {
        try {
            AdmQuestionEvaluation::destroy(Request::get('id'));
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch(exception $ex) {
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
        }
    }

    public function indexCourse()
    {
        $index_course = CourseConduct::latest('id')->with('relCourse','relCourse.relCourseType','relYear','relSemester','relDegree','relDegree.relDepartment')->get();

        return View::make('admission::faculty.course.index',compact('index_course'));

    }


    public function assignCourse($id)
    {
        $assign_course = CourseConduct::findOrFail($id);

        $assign_course_commnt = CourseConductComments::where('course_conduct_id', $id)->get();


        return View::make('admission::faculty.course.assign_course',
            compact('assign_course','assign_course_commnt','id'));

    }

    //ok
    /**
     * @return mixed
     */
    public function commentAssignCourse()
    {
        $info = Input::all();
//        print_r(Input::get('adm_question_id'));exit;
        $model = new CourseConductComments();

        $model->course_conduct_id = $info['course_conduct_id'];
        $model->comments = $info['comments'];
        $model->commented_to = $info['commented_to'];
        $model->commented_by = Auth::user()->get()->id;

//        $user_name = User::FullName($model->commented_to);
        if($model->save()){
            Session::flash('message', 'Comments added');
            return Redirect::back();
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()->with('errors', 'invalid');
        }
    }




}
