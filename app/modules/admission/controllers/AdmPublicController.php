<?php

class AdmPublicController extends \BaseController {

    /*function __construct() {
        $this->beforeFilter('admPublic', array('except' => array('')));
    }*/

	public function degreeOfferList()
	{
        $degreeList = Batch::with('relDegree')->paginate(10);
        return View::make('admission::adm_public.admission.degree_list',compact('degreeList'));

	}
    public function degreeApply(){

        if(Auth::applicant()->check()){
            $batch_ids = Input::get('ids');
            foreach($batch_ids as $key => $value){

                $data = new BatchApplicant();
                $data->batch_id = $value;
                $data->applicant_id = Auth::applicant()->get()->id;

                $degreeApplicantCheck = DB::table('batch_applicant')
                    ->select(DB::raw('1'))
                    ->where('batch_id', '=', $data->batch_id)
                    ->where('applicant_id', '=', $data->applicant_id)
                    ->get();

                if($degreeApplicantCheck){
                    return Redirect::back()->with('info','The selected Degree(s)already added !
                    Please Select One That Is Not Added Yet.');
                }else{
                    $data->save();
                }
            }
            return Redirect::route('admission.public.applicant_details', ['id' => Auth::applicant()->get()->id]);
        } else {
            Session::flash('danger', "You have logged in as ".Auth::user()->get()->username. ".To Apply Please Login As Applicant!");
            //return Redirect::back();
            return Redirect::route('user/login');
        }
    }

    public function degreeOfferDetails($id){

        $degree_model = Batch::with('relDegree','relYear','relSemester',
            'relBatchWaiver.relWaiver')
            ->where('id', '=', $id)
            ->get();

        $major_courses = BatchCourse::with('relBatch','relCourse')
            ->where('batch_id','=',$id)
            ->where('major_minor','=','major')
            ->get();

        $minor_courses = BatchCourse::with('relBatch','relCourse')
            ->where('batch_id','=',$id)
            ->where('major_minor','=','minor')
            ->get();

        $edu_gpa_model = BatchEducationConstraint::with('relBatch')
            ->where('batch_id','=',$id)->get();

        $batch_adm_subject = BatchAdmtestSubject::with('relBatch','relAdmtestSubject')
            ->where('batch_id','=',$id)->get();

        $exm_centers = ExmCenter::get();
        //print_r($exm_centers);exit;
        return View::make('admission::adm_public.admission.degree_detail',
                  compact('degree_model','major_courses', 'minor_courses',
                         'edu_gpa_model','batch_adm_subject','exm_centers'));
    }


    public function degreeOfferApplicantDetails($id){

        $applicant_id = $id;
        $batch_applicant = BatchApplicant::with('relBatch','relBatch.relDegree')
                           ->where('applicant_id', '=',$applicant_id )
                           ->get();
        //print_r($batch_applicant);exit;
        $applicant_personal_info = ApplicantProfile::with('relCountry')
                          ->where('applicant_id', '=',$applicant_id )
                          ->first();
        $applicant_acm_records = ApplicantAcademicRecords::where('applicant_id', '=',$applicant_id )->get();

        $applicant_meta_records = ApplicantMeta::where('applicant_id', '=',$applicant_id )->first();

        return View::make('admission::adm_public.admission.applicant_details',
                  compact('batch_applicant','applicant_personal_info','applicant_acm_records','applicant_meta_records'));
    }
    public function addApplicantAcmDocsPublic(){
        return View::make('admission::adm_public.admission.add_acm_docs');
    }

    public function storeApplicantAcmDocsPublic()
    {

        $rules = array(
//            'level_of_education' => 'required',
//            'degree_name' => 'required',
//            'institute_name' => 'required',
//            'academic_group' => 'required',
//            'board_university' => 'required',
//            'major_subject' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $model = new ApplicantAcademicRecords();
            $model->applicant_id = Input::get('applicant_id');
            $model->level_of_education = Input::get('level_of_education');
            $model->degree_name = Input::get('degree_name');
            $model->institute_name = Input::get('institute_name');
            $model->academic_group = Input::get('academic_group');

            //save board or university according to board_type
            $model->board_type = Input::get('board_type');

            if ($model->board_type == 'board')
                $board_university = Input::get('board_university_board');
            if ($model->board_type == 'university')
                $board_university = Input::get('board_university_university');
            if ($model->board_type == 'other')
                $board_university = Input::get('board_university_other');

            $model->board_university = $board_university;

            $model->major_subject = Input::get('major_subject');
            $model->result_type = Input::get('result_type');

            $model->result = Input::get('result');
            $model->gpa = Input::get('gpa');
            $model->gpa_scale = Input::get('gpa_scale');
            $model->roll_number = Input::get('roll_number');
            $model->registration_number = Input::get('registration_number');
            $model->year_of_passing = Input::get('year_of_passing');
            $model->duration = Input::get('duration');
            $model->study_at = Input::get('study_at');

            $file = Input::file('certificate');

            $destinationPath = public_path().'/applicant_images';
            $extension = $file->getClientOriginalExtension();
            $filename = str_random(12) . '.' . $extension;
            $lower_name = strtolower($filename);
            Input::file('certificate')->move($destinationPath, $lower_name);
            $model->certificate = $filename;

            $model->save();

            return Redirect::route('admission.public.applicant_details', ['id' => Auth::applicant()->get()->id]);
        } else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }
    public function degreeOfferApplicantDocs($id){
        $applicant_id = $id;
        $applicant_acm_records = ApplicantAcademicRecords::where('applicant_id', '=',$applicant_id )->first();
        //print_r($applicant_acm_records);
        return View::make('admission::adm_public.admission.applicant_docs',compact('applicant_acm_records'));

    }


    public function admTestDetails($id){

        //get batch_id
        $batch_id = BatchApplicant::where('id','=',$id)->first()->batch_id;

        $adm_test_details = BatchApplicant::with('relBatch','relBatch.relSemester','relBatch.relYear')
                          ->where('batch_id', '=', $batch_id)
                          ->first();
        //get adm_test_subject according to degree_id
        $adm_test_subject = BatchAdmtestSubject::with('relBatch','relAdmtestSubject')
            ->where('batch_id','=',$batch_id)->get();
        //print_r($adm_test_subject);exit;

        return View::make('admission::adm_public.admission.adm_test_details',
                  compact('adm_test_details','adm_test_subject'));
    }
    public function addMoreDegree(){

        $degreeList = Batch::with('relDegree')->get();
        return View::make('admission::adm_public.admission.add_more_degree',compact('degreeList'));
    }

    public function admDegAptCheckout(){
        $applicant_id = Auth::applicant()->get()->id;
        $degree_applicant = DegreeApplicant::with('relDegree')
            ->where('applicant_id', '=',$applicant_id )
            ->get();
        $applicant_personal_info = ApplicantProfile::with('relCountry')
            ->where('applicant_id', '=',$applicant_id )
            ->first();
        $applicant_meta_records = ApplicantMeta::where('applicant_id', '=',$applicant_id )->first();
        $applicant_acm_records = ApplicantAcademicRecords::where('applicant_id', '=',1 )->get();

        if(empty($applicant_personal_info) || empty($applicant_meta_records) ||  count($applicant_acm_records)< 2 ){
            return Redirect::back()->with('danger', 'Profile or Academic information is Missing! Complete Your profile to checkout!');
        }else{
            return View::make('admission::adm_public.admission.adm_checkouts',
                      compact('degree_applicant'));
        }
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
