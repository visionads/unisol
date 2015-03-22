<?php

class AdmissionController extends \BaseController {

    function __construct()
    {
        $this->beforeFilter('admAmw', array('except' => array('index')));
    }

    public function back(){
        return Redirect::back()->with('error_code', 5);;
    }

// ...............................Admission Test : Admission Test starts here...........................................
//.................................................Desh-Board...........................................................

    public function admAmwDashboard()
    {
        return View::make('admission::amw.admission_test.dashboard');
    }

//.................................................Index................................................................
//    public function admissionTestIndex()
//    {
//        $admission_test = Batch::orderBy('id', 'DESC')->paginate(3);
//
//        $degree_id = Batch::with('relDegree','relDegree.relDepartment','relYear','relSemester')
//            ->first();
//
//
//        $year_id = array('' => 'Select Year ') + Year::lists('title', 'id');
//        $semester_id = array('' => 'Select Semester ') + Semester::lists('title', 'id');
//
//        return View::make('admission::amw.admission_test.index',
//            compact('degree_id','admission_test','year_id','semester_id'));
//    }

    public function searchIndex(){
        $searchQuery = [
            'year_id' =>   Input::get('year_id'),
            'semester_id' =>   Input::get('semester_id'),
        ];

        $model = new Batch();
        $adm_test_data = Helpers::search($searchQuery, $model);
        $year_id = array('' => 'Select Year ') + Year::lists('title', 'id');
        $semester_id = array('' => 'Select Semester ') + Semester::lists('title', 'id');

        return View::make('admission::amw.admission_test._search_index',
            compact('adm_test_data','year_id','semester_id'));
    }

//.................................................Examiner.............................................................

    public function examiners($year_id, $semester_id, $degree_id)
    {
        $adm_examiners_home = AdmExaminer::latest('id')->where('degree_id' ,'=', $degree_id)->paginate(10);
        $data = Degree::with('relDepartment')->where('id' ,'=', $degree_id)->first()->relDepartment->title;

        return View::make('admission::amw.admission_test.examiners',
            compact('data','adm_examiners_home','year_id','semester_id','degree_id'));
    }

    public function viewExaminers($degree_id){
        $adm_view_examiners = AdmExaminer::where('id' ,'=', $degree_id)->first();
        $data = Degree::with('relDepartment')->where('id' ,'=', $degree_id)->first()->relDepartment->title;

        return View::make('admission::amw.admission_test.view_examiners',
            compact('data','adm_view_examiners','degree_id'));
    }

    public function storeExaminers()
    {
        $data = Input::all();
        $adm_examiner_model = new AdmExaminer();

        if ($adm_examiner_model->validate($data))
        {
            // success code
            $adm_examiner_model->degree_id = Input::get('degree_id');
            $adm_examiner_model->user_id = Input::get('user_id');
            $adm_examiner_model->type = Input::get('type');
            $adm_examiner_model->assigned_by = 3;
            $adm_examiner_model->deadline = '2020-20-20 20:20:20';
            $adm_examiner_model->note = 'me note';
            $adm_examiner_model->status = 1;

            if($adm_examiner_model->save()){

                $ad_examiner_comments = new AdmExaminerComments();
                $ad_examiner_comments->degree_id = Input::get('degree_id');
                $ad_examiner_comments->comment = Input::get('comment');
                $ad_examiner_comments->commented_to = Input::get('user_id');
                $ad_examiner_comments->commented_by = Auth::user()->get()->id;
                $ad_examiner_comments->status = 1;

                if($ad_examiner_comments->save()){
                    Session::flash('message', 'Examiner Successfully Added!');
                    return Redirect::back();
                }
            }else{
                // redirect
                Session::flash('error', 'Failed!');
                return Redirect::back();
            }
            // redirect
            Session::flash('message', 'Examiner Successfully Added!');
            return Redirect::to('admission_test/amw/examiners');
        }
    }

//.................................................Question Paper.......................................................

    public function questionPaper($year_id, $semester_id, $degree_id )
    {
//        $adm_question_paper = AdmQuestion::latest('id')->get();  , $degree_admtest_subject_id
        $adm_question_paper = AdmQuestion::latest('id')->get();

//        print_r($adm_question_paper);exit;
        $data = Degree::with('relDepartment')->where('id' ,'=', $degree_id)->first()->relDepartment->title;

        $degree_name = array('' => 'Select Degree ') + Degree::lists('title', 'id');
        $dgr_sbjct_id = array('' => 'Select Degree Admission Test Subject ') + DegreeAdmTestSubject::lists('admtest_subject_id', 'id');

        return View::make('admission::amw.admission_test.question_paper',
            compact('adm_question_paper','year_id','semester_id','degree_id','data','degree_name','dgr_sbjct_id'
            ));
    }

    public function storeQuestionPaper()
    {
        $data = Input::all();
//        $exam_list_id = Input::get('exam_list_id');
//        $course_man_id = Input::get('course_man_id');
//        print_r($exam_list_id);exit;

        $prepare_question_paper = new AdmQuestion();

        if ($prepare_question_paper->validate($data))
        {
            // success code
            $prepare_question_paper->degree_admtest_subject_id = Input::get('degree_admtest_subject_id');
            $prepare_question_paper->examiner_faculty_id = Input::get('examiner_faculty_id');
            $prepare_question_paper->title = Input::get('title');
            $prepare_question_paper->deadline = Input::get('deadline');
            $prepare_question_paper->total_marks = Input::get('total_marks');
            $prepare_question_paper->status = 1;
            $prepare_question_paper->save();

            // redirect
            Session::flash('message', 'Question Paper Successfully Added!');
            return Redirect::back();
        }
        else
        {
            // failure, get errors
            $errors = $prepare_question_paper->errors();
            Session::flash('errors', $errors);

            return Redirect::to('admission_test/amw/question_paper');
        }

    }

    public function viewQuestionPaper($id){
        $view_question_paper = AdmQuestion::find($id);

        return View::make('admission::amw.admission_test.view_question_paper',compact('view_question_paper'));

    }

    public function editQuestionPaper($id){
        $edit_question_paper = AdmQuestion::find($id);

        return View::make('admission::amw.admission_test.edit_question_paper',compact('edit_question_paper'));

    }

    public function updateQuestionPaper(){
        echo "ok";

    }


    public function viewQuestionsItem(){
        Echo "ok";



    }
    public function assignFaculty(){
        Echo "ok";
    }

//.................................................Degree Management....................................................

    public function degreeManagement(){

        $degree_management = Degree::orderBy('id', 'DESC')->paginate(10);

        $department = array('' => 'Select Department ') + Department::lists('title', 'id');
        $semester = array('' => 'Select Semester ') + Semester::lists('title', 'id');
        $year = array('' => 'Select Year ') + Year::lists('title', 'id');
        $degree_program = array('' => 'Please Select ') + DegreeProgram::lists('title', 'id');


        return View::make('admission::amw.admission_test.adm_test_degree',
            compact('degree_management','d_m_year_id','d_m_semester_id',
                'department','semester','year','degree_program'));

    }

    public function searchAdmTestDegree()
    {
        $searchQuery = [
            'year_id' =>   Input::get('year_id'),
            'semester_id' =>   Input::get('semester_id'),
        ];

        $model = new Degree();
        $adm_test_degree = Helpers::search($searchQuery, $model);
        $year = array('' => 'Select Year ') + Year::lists('title', 'id');
        $semester = array('' => 'Select Semester ') + Semester::lists('title', 'id');
        $department = array('' => 'Select Department ') + Department::lists('title', 'id');
        $degree_program = array('' => 'Please Select ') + DegreeProgram::lists('title', 'id');

        return View::make('admission::amw.admission_test._search_adm_test_degree',
            compact('adm_test_degree','year','semester','department','degree_program'));


    }

    public function storeDegreeManagement()
    {
        $data = Input::all();

        $adm_test_degree = new Degree();

        if ($adm_test_degree->validate($data))
        {
            $adm_test_degree->title = Input::get('title');
            $adm_test_degree->description = Input::get('description');
            $adm_test_degree->department_id = Input::get('department_id');
            $adm_test_degree->degree_program_id = Input::get('degree_program_id');
            $adm_test_degree->year_id = Input::get('year_id');
            $adm_test_degree->semester_id = Input::get('semester_id');
            $adm_test_degree->total_credit = Input::get('total_credit');
            $adm_test_degree->duration = Input::get('duration');
            $adm_test_degree->start_date = Input::get('start_date');
            $adm_test_degree->end_date = Input::get('end_date');

            if ($adm_test_degree->save()) {
                return Redirect::to('dmission_test/amw/adm-test-degree')
                    ->with('message', 'Successfully added Information!');
            }
        } else
        {
            $errors = $adm_test_degree->errors();
            Session::flash('errors', $errors);

            return Redirect::back();
        }
    }


    public function viewDegreeManagement($id)
    {
        $view_degree_management = Degree::find($id);

        return View::make('admission::amw.admission_test.view_degree_management',compact('view_degree_management'));
    }


    public function editDegreeManagement($id)
    {
        $edit_degree_management = Degree::find($id);

        $department = array('' => 'Select Department ') + Department::lists('title', 'id');
        $semester = array('' => 'Select Semester ') + Semester::lists('title', 'id');
        $year = array('' => 'Select Year ') + Year::lists('title', 'id');
        $degree_program = array('' => 'Please Select ') + DegreeProgram::lists('title', 'id');

        return View::make('admission::amw.admission_test.edit_degree_management',
            compact('edit_degree_management','department','degree_program','year','semester'));
    }

    public function updateDegreeManagement($id)
    {
        $data = Input::all($id);

        $adm_test_degree = new Degree();

        if ($adm_test_degree->validate($data))
        {
            $adm_test_degree = Degree::find($id);
            $adm_test_degree->title = Input::get('title');
            $adm_test_degree->description = Input::get('description');
            $adm_test_degree->department_id = Input::get('department_id');
            $adm_test_degree->degree_program_id = Input::get('degree_program_id');
            $adm_test_degree->year_id = Input::get('year_id');
            $adm_test_degree->semester_id = Input::get('semester_id');
            $adm_test_degree->total_credit = Input::get('total_credit');
            $adm_test_degree->duration = Input::get('duration');
            $adm_test_degree->start_date = Input::get('start_date');
            $adm_test_degree->end_date = Input::get('end_date');

            if ($adm_test_degree->save()) {
                return Redirect::to('admission_test/amw/adm-test-degree')
                    ->with('message', 'Successfully Updated Information!');
            }
        } else
        {
            $errors = $adm_test_degree->errors();
            Session::flash('errors', $errors);

            return Redirect::back();
        }



    }

//new code


//.................................................Batch Management....................................................

    public function batchManagementIndex()
    {
        $batch_management = Batch::latest('id')->paginate(10);

        $dpg_list = Degree::DegreeProgramGroup();
        $year_list = array('' => 'Year ') +Year::lists('title', 'id');
        $department_list = array('' => 'Department ') +Department::lists('title', 'id');

        return View::make('admission::amw.batch.batch_management_index',
            compact('batch_management','dpg_list','year_list','department_list'));
    }

    public function show($id)
    {
        $b_m_course = Batch::find($id);
        return View::make('admission::amw.batch.show',compact('b_m_course'));
    }

    public function create()
    {
        $dpg_list = Degree::DegreeProgramGroup();

        $year_list = Year::lists('title', 'id');
        $semester_list = Semester::lists('title', 'id');

        return View::make('admission::amw.batch._form',compact('dpg_list','year_list','semester_list'));
    }

    public function store()
    {
        $data = Input::all();

        $model = new Batch();
        if($model->validate($data)){
            if($model->create($data)){
                Session::flash('message', 'Successfully added Information!');
                return Redirect::back();
            }
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()
                ->with('errors', 'invalid');
        }

    }

    public function edit($id)
    {
        $batch_edit = Batch::find($id);

        $dpg_list = Degree::DegreeProgramGroup();
        $year_list = Year::lists('title', 'id');
        $semester_list = Semester::lists('title', 'id');

        return View::make('admission::amw.batch.edit',compact('batch_edit','dpg_list','year_list','semester_list'));
    }

    public function update($id)
    {
        $model = Batch::find($id);
        $data = Input::all();

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
//
//    public function destroy($id)
//    {
//        try {
//            Course::find($id)->delete();
//            return Redirect::back()->with('message', 'Successfully deleted Information!');
//        }
//        catch(exception $ex){
//            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
//        }
//
//    }
//
    public function batchDelete()
    {
        try {
            Batch::destroy(Request::get('id'));
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch(exception $ex) {
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
        }
    }


//..............................................Manage Admission Test Subject...........................................

    public function mngBatchAdmTestSubject($batch_id)
    {
        $degree_test_sbjct = BatchAdmtestSubject::where('batch_id' ,'=', $batch_id)->get();
//        print_r($degree_test_sbjct);exit;
        if($degree_test_sbjct->isEmpty()){
            Session::flash('error', 'There is Nothing to Manage in Admission Test Subject ');
            return Redirect::back();
        }else{
            $degree_name = BatchAdmtestSubject::with('relBatch','relBatch.relDegree')
                ->where('batch_id' ,'=', $batch_id)
                ->first();
            return View::make('admission::amw.batch_adm_test_subject.index',
                compact('batch_id','degree_test_sbjct','degree_name'));
        }
    }

    public function viewBatchAdmTestSubject($id)
    {
        $view_adm_test_subject = BatchAdmtestSubject::find($id);

        return View::make('admission::amw.batch_adm_test_subject.view',compact('view_adm_test_subject'));
    }

    public function createBatchAdmTestSubject($batch_id)
    {
        $subject_id_result = AdmTestSubject::lists('title', 'id');

//        $degree_name = BatchAdmtestSubject::with('relBatch','relBatch.relDegree')
//            ->where('batch_id' ,'=', $batch_id)
//            ->first();

        $degree_name = BatchAdmtestSubject::with('relBatch','relBatch.relDegree')
            ->where('batch_id' ,'=', $batch_id)
            ->first();

        return View::make('admission::amw.batch_adm_test_subject._form',compact('batch_id','degree_name','subject_id_result'));
    }

    public function storeBatchAdmTestSubject()
    {
        $data = Input::all();
        $model = new BatchAdmtestSubject();
//        print_r($data);exit;

        if($model->validate($data)){

            if($model->create($data)){
                Session::flash('message', 'Successfully added Information!');
                return Redirect::back();
            }
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()
                ->with('errors', 'invalid');
        }

    }

    public function editBatchAdmTestSubject($batch_id)
    {
        $batch_edit = BatchAdmtestSubject::find($batch_id);

        $degree_name = BatchAdmtestSubject::with('relBatch','relBatch.relDegree')
            ->where('batch_id' ,'=', $batch_id)
            ->first();

        $subject_id_result = AdmTestSubject::lists('title', 'id');

        return View::make('admission::amw.batch_adm_test_subject.edit',compact('batch_id','degree_name','batch_edit','subject_id_result'));
    }

    public function updateBatchAdmTestSubject($id)
    {
        $model = BatchAdmtestSubject::find($id);
        $data = Input::all();

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


//.................................................Only Subject Management....................................................


    public function AdmissionTestSubjectIndex()
    {
        $admission_test_subject = AdmTestSubject::orderBy('id', 'DESC')->paginate(10);

        return View::make('admission::amw.adm_test_subject.admtest_subject_index',
            compact('admission_test_subject'));

    }

    public function createAdmissionTestSubject()
    {
        return View::make('admission::amw.adm_test_subject._form');
    }

    public function storeAdmissionTestSubject()
    {
        $data = Input::all();
        $model = new AdmTestSubject();
        if($model->validate($data)){
            if($model->create($data)){
                Session::flash('message', 'Successfully added Information!');
                return Redirect::back();
            }
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()
                ->with('errors', 'invalid');
        }

    }

    public function viewAdmissionTestSubject($id)
    {
        $view_admission_test_subject = AdmTestSubject::find($id);
        return View::make('admission::amw.adm_test_subject.view',compact('view_admission_test_subject'));

    }

    public function editAdmissionTestSubject($id)
    {
        $edit_admission_test_subject = AdmTestSubject::find($id);

        return View::make('admission::amw.adm_test_subject.edit',compact('edit_admission_test_subject'));

    }

    public function updateAdmissionTestSubject($id)
    {
        $model = AdmTestSubject::find($id);
        $data = Input::all();

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

//..................................................Admission Test Management : Home.......................................

    public function admissionTestIndex()
    {
        $admission_test_batch = Batch::latest('id')->get();

//        $admission_test_degree = Degree::latest('id')->get();

        $degree_id = Batch::with('relDegree','relDegree.relDepartment','relYear','relSemester')
            ->first();

        $year_id = array('' => 'Select Year ') + Year::lists('title', 'id');
        $semester_id = array('' => 'Select Semester ') + Semester::lists('title', 'id');

        return View::make('admission::amw.adm_test_home.index',
            compact('degree_id','admission_test_batch','admission_test_degree','year_id','semester_id'));
    }

    public function admissionTestSearchIndex()
    {
        $searchQuery = [
            'year_id' =>   Input::get('year_id'),
            'semester_id' =>   Input::get('semester_id'),
        ];

        $model = new Batch();
        $adm_test_home_data = Helpers::search($searchQuery, $model);
        $year_id = array('' => 'Select Year ') + Year::lists('title', 'id');
        $semester_id = array('' => 'Select Semester ') + Semester::lists('title', 'id');

        return View::make('admission::amw.adm_test_home._search_adm_test_home_index',
            compact('adm_test_home_data','year_id','semester_id'));

    }

    public function admissionTestBatchDelete()
    {
        try {
            Batch::destroy(Request::get('id'));
            return Redirect::back()->with('message', 'Successfully deleted Information!');
        }
        catch(exception $ex) {
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
        }


    }


//..................................................Admission Test : Examiner.......................................

    public function admExaminerIndex()
    {
        $adm_test_examiner = AdmExaminer::latest('id')->paginate(10);

        return View::make('admission::amw.adm_examiner.adm_examiner_index',
            compact('adm_test_examiner','year_id','semester_id','degree_id'));

    }

    public function addAdmTestExaminer()
    {
        return View::make('admission::amw.adm_examiner._form');
    }

    public function storeAdmTestExaminer()
    {
        $data = Input::all();
        $model = new AdmExaminer();
        if($model->validate($data)){
            if($model->create($data)){
                Session::flash('message', 'Successfully added Information!');
                return Redirect::back();
            }
        }else{
            $errors = $model->errors();
            Session::flash('errors', $errors);
            return Redirect::back()
                ->with('errors', 'invalid');
        }


    }

    public function viewAdmTestExaminers($degree_id){
//        $adm_view_examiners = AdmExaminer::where('id' ,'=', $degree_id)->first();
//        $data = Degree::with('relDepartment')->where('id' ,'=', $degree_id)->first()->relDepartment->title;
//
//        return View::make('admission::amw.admission_test.view_examiners',
//            compact('data','adm_view_examiners','degree_id'));
    }


//..................................................Admission Test : Question paper.......................................

    public function admQuestionIndex()
    {

        $adm_test_question_paper = AdmQuestion::latest('id')->paginate(10);

        return View::make('admission::amw.adm_question.adm_question_index',compact('adm_test_question_paper'));
    }

    public function createAdmTestQuestionPaper()
    {
        return View::make('admission::amw.adm_question._form');

    }




//..................................................Admission Test : Question Evaluation .......................................

    public function admQuestionEvaluationIndex()
    {
        return View::make('admission::amw.adm_question_evaluation.adm_question_evaluation_index');
    }


}
