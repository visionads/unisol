<?php
class ApplicantController extends \BaseController
{

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

//**************************Applicant Sign Up Start(R)***********************

    public  function index()
    {
        if(isset(Auth::applicant()->get()->id) && Auth::applicant()->get()->id) {
            return View::make('applicant::index');
        }
        else{
            return Redirect::to('/');
        }
    }

    public  function signup()
    {

        return View::make('applicant::signup.signup');
    }

    public function applicant_signup_data_save()
    {
        $token = csrf_token();
        $rules = array(
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:applicant',
            'username' => 'required|unique:applicant',
            'password' => 'regex:((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})|required',
            'confirm_password' => 'Required|same:password',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->Fails()) {
            //Session::flash('message', 'Data Not saved');
            return Redirect::to('/applicant/registration')->withErrors($validator)->withInput();
        } else {
            $verified_code = str_random(30);
            if ($token == Input::get('_token')) {
                $data = new Applicant();
                $data->first_name = Input::get('first_name');
                $data->middle_name = Input::get('middle_name');
                $data->last_name = Input::get('last_name');
                $data->email = Input::get('email');
                $data->username = Input::get('username');
                $data->csrf_token = Input::get('_token');
                $data->password = Hash::make(Input::get('password'));//dd($data->password);
                $data->verified_code = $verified_code;

                if ($data->save()) {
                    $email=$data->email;
                    Mail::send('applicant::signup.authentication', array('link' => $verified_code,'username' => Input::get('first_name')), function($message) use ($email)
                    {
                        $message->from('test@edutechsolutionsbd.com', 'Email Verification');
                        $message->to($email, Input::get('username'));
                        $message->cc('ratnaakter17@gmail.com');
                        $message->subject('Notification');
                    });
                    //return View::make('applicant::signup.mail_notification');
                    Session::flash('message', 'Thanks for signing up! Please check your email.');
                    return Redirect::to('/applicant/registration');
                } else {
                    Session::flash('danger', 'Please try again');
                    return Redirect::to('/applicant/registration');

                }
            }
        }
    }

    public function applicant_signup_confirm($verified_code)
    {
        $user = Applicant::where('verified_code','=',$verified_code);
        if($user->count())
        {
            $user = $user->first();
            $user->verified_code = '';
        }
        Session::flash('message','Your account activated successfully. You can sign in now.');
        return View::make('user::user.login');

    }
    public function Login()
    {
        return View::make('applicant::applicant.login');
    }

//**************************Applicant Change password Start(R)***********************

    public function applicant_change_password()
    {
        return View::make('applicant::signup.change_password');
    }

    public function applicant_change_password_update()
    {
        if(Auth::applicant()->check()) {
            $model = Applicant::findOrFail(Auth::applicant()->get()->id);
            $old_password = Input::get('password');
            $user_password = Auth::applicant()->get()->password;
            if (Hash::check($old_password, $user_password))
            {
                $rules = array(
                    'password' => 'regex:((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})|required',
                    'confirm_password' => 'Required|same:password',
                );
                $validator = Validator::make(Input::all(), $rules);
                if ($validator->passes()) {
                    $model->password = Hash::make(Input::get('new_password'));
                    $model->save();
                    return Redirect::to('applicant/change/password')->with('message', 'Password Successfully Updated.');
                } else {
                    return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
                }
            }
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }


//**********************Applicant's User Account Info Start(R)****************************

    public  function userAccountInfoIndex()
    {
        if(Auth::applicant()->check()) {
            $applicant = Auth::applicant()->get()->id;
            $account = Applicant::where('id', '=', $applicant)->first();
            return View::make('applicant::applicant.user_account_index', compact('account','applicant'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }

    public function userAccountEdit($id)
    {
        $account = Applicant::find($id);
        return View::make('applicant::applicant.edit', compact('account'));
    }

    public  function userAccountUpdate($id)
    {
        if(Auth::applicant()->check()) {
            $rules = array(
               // 'email' => 'required|email|unique:applicant',
               // 'username' => 'required|unique:applicant',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->passes()) {
                DB::beginTransaction();
                try{
                    $account = Applicant::find($id);
                    $account->id = Auth::applicant()->get()->id;
                    $account->first_name = Input::get('first_name');
                    $fflasmsg = $account->first_name;
                    $account->middle_name = Input::get('middle_name');
                    $mflashmsg = $account->middle_name;
                    $account->last_name = Input::get('last_name');
                    $lflashmsg= $account->last_name;
                    $account->username = Input::get('username');
                    $Uflashmsg = $account->username;
                    $account->email = Input::get('email');
                    $Eflashmsg = $account->email;
                    $account->save();
                    DB::commit();
                    return Redirect::back()->with('message', "Successfully Updated FirstName:$fflasmsg, MiddleName:$mflashmsg, LastName:$lflashmsg, UserName:$Uflashmsg, Email:$Eflashmsg !");
                }
                catch ( Exception $e ){
                    //If there are any exceptions, rollback the transaction
                    DB::rollback();
                    Session::flash('danger', " Information is not added.Invalid Request !");
                }
                return Redirect::back();
            }
            else {
                return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
            }
            }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }


//**********************Applicant's Profile Start(R)*********************************

    public function applicantProfileIndex()
    {
        if(Auth::applicant()->check()) {
            $applicant = Auth::applicant()->get()->id;
            $countryList = array('' => 'Please Select') + Country::lists('title', 'id');
            $profile = ApplicantProfile::where('applicant_id', '=', $applicant)->first();
            return View::make('applicant::applicant_profile.index', compact('profile', 'countryList'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }

    }
    public function applicantProfileStore()
    {
        if(Auth::applicant()->check()) {
            $data = Input::all();
            $applicant_model = new ApplicantProfile();
            if ($applicant_model->validate($data)) {
                DB::beginTransaction();
                try{
                $applicant_model->applicant_id = Auth::applicant()->get()->id;
                $FlashMsg= Auth::applicant()->get()->username ;
                $applicant_model->date_of_birth = Input::get('date_of_birth');
                $applicant_model->place_of_birth = Input::get('place_of_birth');
                $applicant_model->gender = Input::get('gender');

                $imagefile = Input::file('profile_image');
                $extension = $imagefile->getClientOriginalExtension();
                $filename = str_random(12) . '.' . $extension;
                $file = strtolower($filename);
                $path = public_path("/applicant_images/profile/" . $file);
                Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);
                $applicant_model->profile_image = $file;

                $applicant_model->city = Input::get('city');
                $applicant_model->state = Input::get('state');
                $applicant_model->country_id = Input::get('country_id');
                $applicant_model->zip_code = Input::get('zip_code');
                $applicant_model->phone = Input::get('phone');
                $applicant_model->save();
                DB::commit();
                return Redirect::back()->with('message', "Successfully Added Infomation to
                 $FlashMsg Profile !");
                }
                catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', " Information is not added.Invalid Request !");
                }
                return Redirect::back();
            }
            else {
                return Redirect::back()->with('error', "Data Not Saved !");
            }
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }

    public function editApplicantProfile($id)
    {
        $profile = ApplicantProfile::find($id);
        $countryList = array('' => 'Please Select') + Country::lists('title', 'id');
        return View::make('applicant::applicant_profile.edit', compact('profile','countryList'));

    }
    public function updateApplicantProfile($id)
    {
        if(Auth::applicant()->check()) {
            $rules = array(
                'date_of_birth' => 'required',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $applicant_model = ApplicantProfile::find($id);
                    $applicant_model->applicant_id = Auth::applicant()->get()->id;
                    $FlashMsg= Auth::applicant()->get()->username ;
                    $applicant_model->date_of_birth = Input::get('date_of_birth');
                    $applicant_model->place_of_birth = Input::get('place_of_birth');
                    $applicant_model->gender = Input::get('gender');

                    $imagefile = Input::file('profile_image');
                    $extension = $imagefile->getClientOriginalExtension();
                    $filename = str_random(12) . '.' . $extension;
                    $file = strtolower($filename);
                    $path = public_path("/applicant_images/profile/" . $file);
                    Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);

                    $applicant_model->profile_image = $file;
                    $applicant_model->city = Input::get('city');
                    $applicant_model->state = Input::get('state');
                    $applicant_model->country_id = Input::get('country_id');
                    $applicant_model->zip_code = Input::get('zip_code');
                    $applicant_model->phone = Input::get('phone');
                    $applicant_model->save();
                    DB::commit();
                    return Redirect::back()->with('message', "Successfully Updated Infomation to $FlashMsg Profile !");
                } catch (Exception $e) {
                    //If there are any exceptions, rollback the transaction
                    DB::rollback();
                    Session::flash('danger', "$FlashMsg Profile Information is not added.Invalid Request !");
                }
                return Redirect::back();
            }
            else {
                return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
            }
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }
    public function editProfileImage($id)
    {
        $profile = ApplicantProfile::find($id);
        return View::make('applicant::applicant_profile.edit_image', compact('profile'));
    }

    public function updateProfileImage($id)
    {
        $rules = array(
            'profile_image' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $profile = ApplicantProfile::find($id);
                $FlashMsg= Auth::applicant()->get()->username ;
                $imagefile = Input::file('profile_image');
                $extension = $imagefile->getClientOriginalExtension();
                $filename = str_random(12) . '.' . $extension;
                $file = strtolower($filename);
                $path = public_path("/applicant_images/profile/" . $file);
                Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);
                $profile->profile_image = $file;
                $profile->save();
                DB::commit();
                return Redirect::back()->with('message', "Successfully Updated $FlashMsg Profile Picture !");
            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', " Information is not added.Invalid Request !");
            }
            return Redirect::back();

        } else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }

    }

//********************Applicant Academic Records Start(R)******************************

    public function acmRecordsIndex()
    {
        if(Auth::applicant()->check()) {
            $applicant= Auth::applicant()->get()->id;
            $model = ApplicantAcademicRecords::where('applicant_id', '=', $applicant)->get();
            return View::make('applicant::apt_academic_records.index', compact('model','applicant'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }

//!!!!!!!Academic records code for save and update is in  AdmPublicController!!!!!!!!!!

    public function acmRecordsStore(){

        $rules = array(
            'level_of_education' => 'required',
            'degree_name' => 'required',
            'institute_name' => 'required',
            'academic_group' => 'required',
            'board_type' => 'required',
            'major_subject' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $model =new ApplicantAcademicRecords();
            $model->applicant_id = Auth::applicant()->get()->id;
            $model->level_of_education = Input::get('level_of_education');
            $model->degree_name = Input::get('degree_name');
            $model->institute_name = Input::get('institute_name');
            $model->academic_group = Input::get('academic_group');

            //save board or university according to board_type
            $model->board_type = Input::get('board_type');

            if($model->board_type == 'board')
                $board_university = Input::get('board_university_board');
            if($model->board_type == 'university')
                $board_university = Input::get('board_university_university');
            if($model->board_type == 'other')
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

            $model->save();
            //echo $model;
            //return Redirect::back()->with('message', 'Successfully added Information!');
            return Redirect::to('apt/acm_records/')->with('message', 'successfully added');
        } else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }

    }
    public function acmRecordsEdit($id){
        $model= ApplicantAcademicRecords::find($id);
        return View::make('applicant::apt_academic_records.modals.edit', compact('model'));
    }
    public function acmRecordsUpdate($id){
        $rules = array(
            'level_of_education' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {

            $model = ApplicantAcademicRecords::find($id);
            $model->level_of_education = Input::get('level_of_education');
            $model->degree_name = Input::get('degree_name');
            $model->institute_name = Input::get('institute_name');
            $model->academic_group = Input::get('academic_group');
            //update board or university according to board_type
            $model->board_type = Input::get('board_type');
            if($model->board_type == 'board')
                $board_university = Input::get('board_university_board');
            if($model->board_type == 'university')
                $board_university = Input::get('board_university_university');
            if($model->board_type == 'other')
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
            $model->save();
            return Redirect::back()->with('message', 'Successfully updated Information!');
        } else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }

    }
    public function acmRecordsShow($id)
    {
        $model = ApplicantAcademicRecords::find($id);
        return View::make('applicant::apt_academic_records.modals.show',compact('model'));
    }
    public function academicDelete($id){

        ApplicantAcademicRecords::find($id)->delete();
        return Redirect::back()->with('message', 'Successfully deleted Information!');
    }


//**************************Applicant Meta Information/Personal Info Start(R)*********

    public function personalInfoIndex()
    {
        if(Auth::applicant()->check()) {
            $applicant = Auth::applicant()->get()->id;
            $applicant_personal_info = ApplicantMeta::where('applicant_id', '=',$applicant )
                ->first();
            return View::make('applicant::applicant_personal_info.index',compact('applicant_personal_info','applicant'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }

    }

    public function personalInfoCreate(){
        return View::make('applicant::applicant_personal_info._form');
    }

    public function personalInfoStore()
    {
        $rules = array(
            'national_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            DB::beginTransaction();
            try{
            $applicant_personal_info =new ApplicantMeta();
            $applicant_personal_info->applicant_id = Auth::applicant()->get()->id;
            $FlashMsg= Auth::applicant()->get()->username ;
            $applicant_personal_info->fathers_name = Input::get('fathers_name');
            $applicant_personal_info->mothers_name = Input::get('mothers_name');
            $applicant_personal_info->fathers_occupation = Input::get('fathers_occupation');
            $applicant_personal_info->fathers_phone = Input::get('fathers_phone');
            $applicant_personal_info->freedom_fighter = Input::get('freedom_fighter');
            $applicant_personal_info->mothers_occupation = Input::get('mothers_occupation');
            $applicant_personal_info->mothers_phone = Input::get('mothers_phone');
            $applicant_personal_info->national_id = Input::get('national_id');
            $applicant_personal_info->driving_licence = Input::get('driving_licence');
            $applicant_personal_info->passport = Input::get('passport');
            $applicant_personal_info->national_id = Input::get('national_id');
            $applicant_personal_info->marital_status = Input::get('marital_status');
            $applicant_personal_info->religion = Input::get('religion');

            $imagefile = Input::file('signature');
            $extension = $imagefile->getClientOriginalExtension();
            $filename = str_random(12) . '.' . $extension;
            $file = strtolower($filename);
            $path = public_path("/applicant_images/app_meta/" . $file);
            Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);
            $applicant_personal_info->signature  = $file;

            $applicant_personal_info->present_address = Input::get('present_address');
            $applicant_personal_info->permanent_address = Input::get('permanent_address');
            $applicant_personal_info->save();
            DB::commit();
            return Redirect::back()->with('message', "Successfully Added $FlashMsg Personal Information !");
            }
            catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', " $FlashMsg Personal Information  is not added.Invalid Request !");
            }
            return Redirect::back();
        } else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }

    }

    public function personalInfoEdit($id){
        $applicant_personal_info = ApplicantMeta::find($id);
        return View::make('applicant::applicant_personal_info.edit', compact('applicant_personal_info'));
    }
    public function personalInfoUpdate($id){
        $rules = array(
            'national_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $applicant_personal_info = ApplicantMeta::find($id);
                $applicant_personal_info->applicant_id = Auth::applicant()->get()->id;
                $FlashMsg= Auth::applicant()->get()->username ;
                $applicant_personal_info->fathers_name = Input::get('fathers_name');
                $applicant_personal_info->mothers_name = Input::get('mothers_name');
                $applicant_personal_info->fathers_occupation = Input::get('fathers_occupation');
                $applicant_personal_info->fathers_phone = Input::get('fathers_phone');
                $applicant_personal_info->freedom_fighter = Input::get('freedom_fighter');
                $applicant_personal_info->mothers_occupation = Input::get('mothers_occupation');
                $applicant_personal_info->mothers_phone = Input::get('mothers_phone');
                $applicant_personal_info->national_id = Input::get('national_id');
                $applicant_personal_info->driving_licence = Input::get('driving_licence');
                $applicant_personal_info->passport = Input::get('passport');
                $applicant_personal_info->national_id = Input::get('national_id');
                $applicant_personal_info->marital_status = Input::get('marital_status');
                $applicant_personal_info->religion = Input::get('religion');

                $imagefile = Input::file('signature');
                $extension = $imagefile->getClientOriginalExtension();
                $filename = str_random(12) . '.' . $extension;
                $file = strtolower($filename);
                $path = public_path("/applicant_images/app_meta/" . $file);
                Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);
                $applicant_personal_info->signature = $file;

                $applicant_personal_info->present_address = Input::get('present_address');
                $applicant_personal_info->permanent_address = Input::get('permanent_address');
                $applicant_personal_info->save();
                DB::commit();
                return Redirect::back()->with('message', "Successfully Updated $FlashMsg Personal Information !");
            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', " $FlashMsg Personal Information  is not Updated.Invalid Request !");
            }
            return Redirect::back();
        }
        else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

    public function edit_signature($id)
    {
        $signature = ApplicantMeta::find($id);
        return View::make('applicant::applicant_personal_info.edit_signature', compact('signature'));
    }

    public function update_signature($id)
    {
        $rules = array(
            'signature' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
            $signature = ApplicantMeta::find($id);
            $FlashMsg= Auth::applicant()->get()->username ;
            $imagefile = Input::file('signature');
            $extension = $imagefile->getClientOriginalExtension();
            $filename = str_random(12) . '.' . $extension;
            $file = strtolower($filename);
            $path = public_path("/applicant_images/app_meta/" . $file);
            Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);
            $signature->signature  = $file;
            $signature->save();
            DB::commit();
            return Redirect::back()->with('message', "Successfully updated $FlashMsg Signatures !");
            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', " $FlashMsg Signatures  is not Updated.Invalid Request !");
            }
            return Redirect::back();
        } else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }

    }


//***********************Applicant's Supporting Docs Start(R)*************************

    public function sDocsIndex()
    {
        if(Auth::applicant()->check()) {
            $applicant= Auth::applicant()->get()->id;
            $supporting_docs = ApplicantSupportingDoc::where('applicant_id', '=', $applicant)->first();
            if(!$supporting_docs){
                $supporting_docs = new ApplicantSupportingDoc();
                $supporting_docs->applicant_id = Auth::applicant()->get()->id;
                $supporting_docs->save();
            }
            return View::make('applicant::applicant_supporting_docs.index', compact('supporting_docs', 'doc_type'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }


    }
    public function sDocsView($doc_type, $sdoc_id)
    {
        $supporting_docs = ApplicantSupportingDoc::where('id', '=', $sdoc_id)->first();
        if(!$supporting_docs)
            $supporting_docs = null;

        return View::make('applicant::applicant_supporting_docs.modals.supporting_docs', compact('supporting_docs', 'doc_type'));
    }

    public function sDocsStore()
    {
        $data = Input::all();
        $sdoc = $data['id'] ? ApplicantSupportingDoc::find($data['id']) : new ApplicantSupportingDoc;
        if ($data['doc_type']=='other') {
            $sdoc->other = Input::get('other');
        } else {
            $file = Input::file('doc_file');
            $extension = $file->getClientOriginalExtension();
            $filename = str_random(12) . '.' . $extension;
            $sdoc_file=strtolower($filename);
            $path = public_path("/applicant_images/supporting_doc/" . $sdoc_file);
            Image::make($file->getRealPath())->resize(100, 100)->save($path);
            $sdoc->$data['doc_type'] =$sdoc_file;
        }
        if ($sdoc->save())
            return Redirect::to('applicant/supporting_docs/')->with('message', 'successfully added');
        else
            return Redirect::to('applicant/supporting_docs/')->with('message', 'Not Added');
    }


 //********************Applicant Extra-Curricular Activities Start(R)***************

    public function extraCurricularIndex()
    {
        if(Auth::applicant()->check()) {
            $datas = ApplicantExtraCurrActivity::orderBy('id', 'DESC')->paginate(5);
            $applicant = Auth::applicant()->get()->id;
            $data = ApplicantExtraCurrActivity::where('applicant_id', '=', $applicant)->first();
            return View::make('applicant::extra_curricular.index', compact('data','datas'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }

    }

    public function extraCurricularCreate(){
        return View::make('applicant::extra_curricular._form');
    }

    public function applicantExtraCurricularStore(){

        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
            $extra_curricular =new ApplicantExtraCurrActivity();
            $extra_curricular->applicant_id = Auth::applicant()->get()->id;
            $FlashMsg= Auth::applicant()->get()->username ;
            $extra_curricular->title = Input::get('title');
            $extra_curricular->description = Input::get('description');
            $extra_curricular->achievement = Input::get('achievement');
            $imagefile = Input::file('certificate_medal');
            $extension = $imagefile->getClientOriginalExtension();
            $filename = str_random(12) . '.' . $extension;
            $file = strtolower($filename);
            $path = public_path("/applicant_images/extra_curri_act/" . $file);
            Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);
            $extra_curricular->certificate_medal  = $file;
            $extra_curricular->save();
            DB::commit();
            return Redirect::back()->with('message', "Successfully Added $FlashMsg Extra Curricular Information !");
            }
            catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', "$FlashMsg Extra Curricular Information Is not Added.Invalid Request !");
            }
            return Redirect::back();
        } else {
            return Redirect::to('applicant/extra_curricular/')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }

    }

    public function editExtraCurricular($id)
    {
        $extra_curricular = ApplicantExtraCurrActivity::find($id);
        return View::make('applicant::extra_curricular.edit', compact('extra_curricular'));
    }

    /**
     * @param $id
     * @return mixed ->
     */
    public function updateExtraCurricular($id)
    {
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $extra_curricular = ApplicantExtraCurrActivity::find($id);
                $FlashMsg= Auth::applicant()->get()->username ;
                $extra_curricular->title = Input::get('title');
                $extra_curricular->description = Input::get('description');
                $extra_curricular->achievement = Input::get('achievement');
                $imagefile = Input::file('certificate_medal');
                $extension = $imagefile->getClientOriginalExtension();
                $filename = str_random(12) . '.' . $extension;
                $file = strtolower($filename);
                $path = public_path("/applicant_images/extra_curri_act/" . $file);
                Image::make($imagefile->getRealPath())->resize(100, 100)->save($path);
                $extra_curricular->certificate_medal = $file;
                $extra_curricular->save();
                DB::commit();
                return Redirect::back()->with('message', "Successfully Updated $FlashMsg Extra Curricular Information !");
            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', "$FlashMsg Extra Curricular Information is not Updated.Invalid Request !");
            }
            return Redirect::back();
        }
        else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }
    public function applicantExtraCurricularShow($id)
    {
        $datas = ApplicantExtraCurrActivity::find($id);
        return View::make('applicant::extra_curricular.show', compact('datas'));

    }

    public function applicantExtraCurricularDelete($id)
    {
        try {
            $data= ApplicantExtraCurrActivity::find($id);
            if($data->delete())
            {
                Session::flash('danger', "Activities Deleted successfully");
                //return Redirect::back();
                return Redirect::to('applicant/extra_curricular/');
            }
        }
        catch
        (exception $ex){
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');

        }
    }


//***********************Applicant Miscellaneous Information Start(R)*************************

    public function miscInfoIndex()
    {
        if(Auth::applicant()->check()) {
            $applicant= Auth::applicant()->get()->id;
            $data = ApplicantMiscInfo::where('applicant_id', '=', $applicant)->first();
            return View::make('applicant::applicant_miscellaneous_info.index',compact('data','applicant'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }

    }

    public function miscInfoCreate(){
        return View::make('applicant::applicant_miscellaneous_info.modal.miscellaneous');
    }

    public function miscInfoStore(){
        $rules = array(
            'ever_admit_this_university' => 'required',
            'ever_dismiss' => 'required',
            'academic_honors_received' => 'required',
            'ever_admit_other_university' => 'required',
            'admission_test_center' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
            $data =new ApplicantMiscInfo();
            $data->applicant_id = Auth::applicant()->get()->id;
            $FlashMsg= Auth::applicant()->get()->username ;
            $data->ever_admit_this_university = Input::get('ever_admit_this_university');
            $data->ever_dismiss = Input::get('ever_dismiss');
            $data->academic_honors_received = Input::get('academic_honors_received');
            $data->ever_admit_other_university = Input::get('ever_admit_other_university');
            $data->admission_test_center = Input::get('admission_test_center');
            $data->save();
            DB::commit();
            return Redirect::back()->with('message', "Successfully Added $FlashMsg Miscellaneous Information !");
            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', "$FlashMsg Miscellaneous Information is not Added.Invalid Request !");
            }
            return Redirect::back();
        }
        else {
           return Redirect::to('applicant/misc_info/')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

    public function miscInfoEdit($id){
        $model= ApplicantMiscInfo::find($id);
        return View::make('applicant::applicant_miscellaneous_info.modal.edit', compact('model'));
    }

    public function miscInfoUpdate($id){
        $data= Input::all();
        $rules = array(
            'ever_admit_this_university' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()){
            DB::beginTransaction();
            try {
            $model = ApplicantMiscInfo::find($id);
            $FlashMsg= Auth::applicant()->get()->username ;
            $model->ever_admit_this_university = Input::get('ever_admit_this_university');
            $model->ever_dismiss = Input::get('ever_dismiss');
            $model->academic_honors_received = Input::get('academic_honors_received');
            $model->ever_admit_other_university = Input::get('ever_admit_other_university');
            $model->admission_test_center = Input::get('admission_test_center');
            $model->save();
            DB::commit();
            return Redirect::back()->with('message', "Successfully Updated $FlashMsg Miscellaneous Information !");
            } catch (Exception $e) {
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', "$FlashMsg Miscellaneous Information is not Updated.Invalid Request !");
            }
            return Redirect::back();
        } else {
            return Redirect::back()->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }

    }


//{*********Admission :Starts Degree Apply By Applicant (Tanin)  ****************}

    public function applyDegreeByApplicant($degree_id)
    {
        if(Auth::applicant()->check()) {
            $deg_id = Batch::where('id', '=', $degree_id)->first()->degree_id;

            if ($deg_id) {
                $applied_degree_id = Session::get('applicantDegIds');

                $applied_degree_ids = array_merge(array($deg_id), (array)$applied_degree_id);

                Session::put('applicantDegIds', $applied_degree_ids);
            } else {
                $applied_degree_ids = (array)Session::get('applicantDegIds');
            }
            $data = Batch::with('relDegree', 'relDegree.relDegreeGroup', 'relDegree.relDegreeProgram', 'relDegree.relDegreeLevel')->where('degree_id', '=', $applied_degree_ids)->get();

            return Redirect::route('applicant.details', ['id' => Auth::applicant()->get()->id]);
        }else{
            Auth::logout();
            //Session::flush(); //delete the session
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }

    public function degreeApply(){

        if(Auth::applicant()->check()){
            if(Session::has('applicantDegIds'))
                $batch_ids = Session::get('applicantDegIds');
            else
                $batch_ids = Input::get('ids');
            if($batch_ids){
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
                        Session::flash('info','The selected Degree(s)already added ! If You Want To Add More Please Select One That Is Not Added Yet Using "Add More Degree" Button.');
                    }else{
                        $data->save();
                    }
                }
            }else{
                Session::flash('info', "Please Select Degree From Degree List!");
                return Redirect::back();
            }
            return Redirect::route('applicant.details', ['id' => Auth::applicant()->get()->id]);
        } else {
            // Remember this link to redirect after applicant login.
            // If single degree is selected then it should redirect to degree details page.
            $degreeIds = Input::get('ids');
            if(count($degreeIds) == 1)
                Session::put('applicantRedirect', 'admission/public/degree-offer-details/'.$degreeIds[0]);
            else
                Session::put('applicantRedirect', 'admission/public/degree-offer-list');
            Session::put('applicantDegIds', $degreeIds);

            Auth::logout();
            //Session::flush(); //delete the session
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }
    }

   // $id refers to applicant_id in DB table : BatchApplicant
    public function applicantDetails(){

        $apt_id = Auth::applicant()->get()->id;

        $applied_degree_ids = Session::get('applicantDegIds');

        $data = Batch::with('relDegree','relDegree.relDegreeGroup','relDegree.relDegreeProgram','relDegree.relDegreeLevel')->whereIn('degree_id',$applied_degree_ids)->get();

        $applicant_personal_info = ApplicantProfile::with('relCountry')
            ->where('applicant_id', '=',$apt_id )
            ->first();
        $applicant_acm_records = ApplicantAcademicRecords::where('applicant_id', '=',$apt_id )->get();

        $applicant_meta_records = ApplicantMeta::where('applicant_id', '=',$apt_id )->first();

        return View::make('applicant::applicant.details',
            compact('batch_applicant','applicant_personal_info','applicant_acm_records',
                'applicant_meta_records','applied_degree_ids','data'));
    }

    public function addMoreDegree(){

        $degreeList = Batch::with('relDegree','relYear','relSemester','relDegree.relDegreeGroup','relDegree.relDepartment')->get();
        return View::make('admission::adm_public.admission.add_more_degree',compact('degreeList'));
    }

    // $id refers to batch_id
    public function admTestDetails($id){

        $data = Batch::with('relDegree','relDegree.relDegreeGroup','relDegree.relDegreeProgram','relDegree.relDegreeLevel','relYear','relSemester')->where('id',$id)->first();

        $adm_test_subject = BatchAdmtestSubject::with('relBatch','relAdmtestSubject')
            ->where('batch_id','=',$id)->get();

        $exm_centers_all = ExmCenter::all();

        return View::make('admission::adm_public.admission.adm_test_details',
            compact('data','adm_test_subject','exm_centers_all','id'));
    }

    public function admExmCenter(){

        $center_id = Input::get('id');

        if ($center_id) {
            $exm_center_id = Session::get('ExmCenterIds');

            $exm_center_ids = array_merge(array($center_id), (array)$exm_center_id);
            print_r($exm_center_ids);exit;
            Session::put('ExmCenterIds',$exm_center_ids);
        }else{
            $exm_center_ids = (array)Session::get('ExmCenterIds');
        }
//        print_r($exm_center_ids);exit;

       /* $batch_applicant_id = ['batch_applicant_id' => $batch_applicant_id];
        $rules = ['batch_applicant_id' => 'exists:exm_center_applicant_choice'];
        $validator = Validator::make($batch_applicant_id, $rules);

        if ($validator->Fails()) {
            $exm_centers_all = ExmCenter::all();
        }else{
            $exm_center_choice = ExmCenterApplicantChoice::with('relExmCenter')->where('batch_applicant_id','=',$id)->get();
        }*/

        return View::make('admission::adm_public.admission.exm_center',
            compact('exm_centers_all','exm_center_choice','id'));
    }

    public function admExmCenterSave(){

        $id = Input::get('id');

        $batch_applicant_id = Input::get('batch_applicant_id');
        $exm_center_id = Input::get('exm_center_id');

        for($i=0; $i < count($exm_center_id); $i++) {
            $model = isset($id[$i]) ? ExmCenterApplicantChoice::findOrFail($id[$i]) : new ExmCenterApplicantChoice();
            $model->batch_applicant_id = $batch_applicant_id;
            $model->exm_center_id = $exm_center_id[$i];
            $model->save();
        }
        Session::flash('message',  ' Successfully performed This Request!');
        return Redirect::back();
    }

    public function admPaymentCheckoutByApplicant(){

        $applied_degree_ids = Session::get('applicantDegIds');
//        print_r($applied_degree_ids);exit;

        $data = Batch::with('relDegree','relDegree.relDegreeGroup','relDegree.relDegreeProgram','relDegree.relDegreeLevel')->whereIn('degree_id',$applied_degree_ids)->get();
//        print_r($data);exit;
        $applicant_id = Auth::applicant()->get()->id;
        $batch_applicant = BatchApplicant::with('relBatch','relBatch.relDegree','relBatch.relDegree.relDegreeGroup','relBatch.relDegree.relDepartment')
            ->where('applicant_id', '=',$applicant_id )
            ->get();
        $applicant_personal_info = ApplicantProfile::with('relCountry')
            ->where('applicant_id', '=',$applicant_id )
            ->first();
        $applicant_meta_records = ApplicantMeta::where('applicant_id', '=',$applicant_id )->first();
        $applicant_acm_records = ApplicantAcademicRecords::where('applicant_id', '=',$applicant_id )->get();

        if(empty($applicant_personal_info) || empty($applicant_meta_records) ||  count($applicant_acm_records)< 2 ){
            return Redirect::back()->with('danger', 'Profile or Academic information is Missing! Complete Your profile to checkout!');
        }else{
            return View::make('admission::adm_public.admission.adm_checkouts',
                compact('batch_applicant','data'));
        }
    }
//{*********Admission :Ends Degree Apply By Applicant (Tanin)  ****************}





    public function admission_test()
    {
        if(Auth::applicant()->check()) {
            $applicant_id = Auth::applicant()->get()->id;
            $data = BatchApplicant::with('relBatch','relBatch.relDegree','relBatch.relSemester','relBatch.relYear')
                ->where('applicant_id', '=', $applicant_id)
                ->get();
            return View::make('applicant::admission_test.index',compact('data','applicant'));
        }
        else {
            Session::flash('danger', "Please Login As Applicant!  Or if not registered applicant then go <a href='/applicant/signup'>signup from here</a>");
            return Redirect::route('user/login');
        }

    }

    public function admission_test_subject($batch_id)
    {
        $batch_applicant = BatchApplicant::with('relBatch','relBatch.relDegree','relBatch.relSemester','relBatch.relYear')
            ->where('batch_id', '=', $batch_id)->first();

        $test_subject = BatchAdmtestSubject::with('relBatch','relAdmtestSubject','relAdmQuestion')
            ->where('batch_id', '=', $batch_id)->get();

        return View::make('applicant::admission_test.subject_details',compact('test_subject','batch_applicant','question'));
    }

    public function admission_test_subject_exam($batch_id, $admtest_subject_id)
    {
        $data = BatchAdmtestSubject::where('batch_id', $batch_id)->where('admtest_subject_id', $admtest_subject_id)->first();
        $adm_question = AdmQuestion::where('batch_admtest_subject_id', $data->id)->first();
        if($adm_question){
            $adm_question_id = $adm_question->id;
        }else{
            $adm_question_id = '';
        }
        $batch_admtest_subject_id = $data->id;

        return View::make('applicant::admission_test.subject_exam',compact('data', 'adm_question_id', 'batch_admtest_subject_id'));
    }

    public function start_admission_test(){

        //Get Post Data
        $adm_question_id = Input::get('adm_question_id');
        $batch_admtest_subject_id = Input::get('batch_admtest_subject_id');
        $question_number = Input::get('question_number');
        $finish = Input::get('finish');

        // Common Data from Batch Admtest Subject
        $data = BatchAdmtestSubject::with('relAdmtestSubject')
            ->where('id', $batch_admtest_subject_id)->first();
        //All question item list
        $all_items = AdmQuestionItems::where('adm_question_id', $adm_question_id)->get();
        //convert question item's id in an Array()
        $q_item_id = [];
        foreach($all_items as $item){
            $q_item_id [] = $item->id;
        }
        //Total Question
        $total_question_item = count($all_items);
        // question sequence number
        $q_no = isset($question_number) ? $question_number : 0;
        //Option and answer according to the question item
        if($q_no < $total_question_item){
            $question_ans_opt = AdmQuestionItems::with('relAdmQuestionOptAns')
                ->where('id', $q_item_id[$q_no])->get();
        }

        //Save Procedure
        $adm_question_items_id = Input::get('adm_question_items_id');
        $question_type = Input::get('question_type');
        if( !empty($adm_question_id) || !empty( $adm_question_items_id ) ){
            DB::beginTransaction();
            try{
                $model = new AdmQuestionEvaluation();
                $model->batch_applicant_id = Auth::applicant()->get()->id;
                $model->adm_question_id = $adm_question_id;
                $model->adm_question_items_id = Input::get('adm_question_items_id');
                if($model->save()){
                    if($question_type == 'text'){
                        /*$ans_text = new AdmQuestionAnsText();
                        $ans_text->amd_question_evaluation_id = $model->id;
                        $ans_text->answer = Input::get('text_answer');
                        $ans_text->save();*/
                    }elseif($question_type == 'radio'){
                        /*$ans_radio = new AdmQuestionAnsRadio();
                        $ans_radio->amd_question_evaluation_id = $model->id;
                        $ans_radio->answer = Input::get('radio_answer');
                        $ans_radio->save();*/
                    }elseif($question_type == 'checkbox'){
                        /*$ids = Input::get('checkbox_answer');
                        for($i=0; $i<count($ids); $i++){
                            $ans_checkbox = new AdmQuestionAnsCheckbox();
                            $ans_checkbox->amd_question_evaluation_id = $model->id;
                            $ans_checkbox->answer = $ids[$i];
                            $ans_checkbox->save();
                        }*/
                    }
                }
                DB::commit();
                Session::flash('success', "Saved Successfully !");
            }
            catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('danger', "Invalid Request !");
            }
        }
        // redirect or render to method / view
        if($finish != 9){
            Session::flash('success', "Saved Successfully !");
            return View::make('applicant::admission_test.exam_question_item', compact(
                'data', 'total_question_item' , 'q_no' , 'question_ans_opt',
                'adm_question_id', 'batch_admtest_subject_id'
            ));
        }else{
            Session::flash('success', "Saved Successfully !");
            return Redirect::to('applicant/admission-test');
            //return Redirect::to('applicant/admission-test-subject/'.$batch_id);
        }

    }
}

