<?php

class FeesController extends \BaseController {

    function __construct() {
        $this->beforeFilter('feesAmw', array('except' => array('')));
    }

    /*
    * POST REQUEST To save data
    */
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    /**********************Billing Setup Start***************************/

    public function indexBillingSetup()
    {
        $degree = ['' => 'Select Degree'] + DegreeProgram::lists('title', 'id');
        $batch = ['' => 'Select Batch'] + Batch::lists('batch_number', 'id');

        $degree_id = Input::get("degree_id");
        $batch_id = Input::get("batch_id");
        Input::flash();

        $q = BillingSetup::with('relBillingSchedule','relBillingSchedule','relBatch','relBatch.relDegree.relDegreeProgram');

        if (!empty($degree_id)) {
            $q->whereExists(function($query) use ($degree_id)
            {
                $query->from('batch')
                    ->whereRaw('batch.id = billing_setup.batch_id')
                    ->where('batch.degree_id', $degree_id);
            });
        }
        if (!empty($batch_id)) {
            $q->where(function($query) use ($batch_id) {
                $query->where('batch_id', '=', $batch_id);
            });
        }
        $data = $q->orderBy('id', 'DESC')->paginate(10);


        /* $query = DB::table('billing_setup AS bs')
             ->select(
                 'bs.id as id',
                 'bs.cost as cost',
                 'bsc.title as scheduleTitle',
                 'bi.title as billingTitle',
                 'bs.deadline as deadline',
                 'bs.fined_cost as fined_cost'
             )
             ->join('billing_schedule as bsc', 'bsc.id', '=', 'bs.billing_schedule_id')
             ->join('billing_item AS bi', 'bi.id', '=', 'bs.billing_item_id')
             ->join('batch AS b', 'bs.batch_id','=', 'b.id')
             ->join('degree AS d','b.degree_id', '=', 'd.id');

         if(!empty($batch_id))
             $query->where('bs.batch_id', '=', $batch_id);

         if(!empty($degree_id))
             $query->where('d.id', '=', $degree_id);

         $data = $query->paginate(10);*/

        return View::Make('fees::billing_setup.index', compact('degree', 'batch','data'));
    }

    public function createBillingSetup()
    {
        $degree = ['' => 'Select Degree'] + DegreeProgram::lists('title', 'id');
        $batch_id = ['' => 'Select Batch']+ Batch::lists('batch_number', 'id');
        $schedule_id = ['' => 'Select Billing Schedule']+ BillingSchedule::lists('title', 'id');
        $item_id = ['' => 'Select Billing Item']+ BillingItem::lists('title', 'id');
        return View::Make('fees::billing_setup.create',compact('billing_setup','degree','batch_id','schedule_id','item_id'));

    }

    public function createAjaxBatchList()
    {
        $degree_prog_id = Input::get('degree');
        $degree = Degree::where('degree_program_id', $degree_prog_id)->first();
        $deg_id = $degree->id;
        $Batch = Batch::where('degree_id', '=', $deg_id)->lists('batch_number', 'id');
        if($Batch){
            return Response::make(['Please select one']+ $Batch);
        }else{
            return Response::make(['No data found']);
        }

    }

    public function storeBillingSetup()
    {
        if($this->isPostRequest()) {
            $data = Input::all();
            $model = new BillingSetup();
            if ($model->validate($data)) {
                DB::beginTransaction();
                try {
                    $model->billing_schedule_id = Input::get('schedule_id');
                    $model->billing_item_id = Input::get('item_id');
                    $model->batch_id = Input::get('batch_id');
                    $model->cost = Input::get('cost');
                    $model->deadline = Input::get('deadline');
                    $model->fined_cost = Input::get('fined');
                    $model->save();
                    DB::commit();
                    Session::flash('message', "Billing is Setup Successfully");
                    return Redirect::back();
                }
                catch ( Exception $e ){
                        //If there are any exceptions, rollback the transaction
                        DB::rollback();
                        Session::flash('danger', "not added.Invalid Request!");
                    }
                    return Redirect::back();
            } else {
                $errors = $model->errors();
                Session::flash('errors', $errors);
                return Redirect::back()
                    ->with('errors', 'invalid');
            }
        }
        return Redirect::back();
    }

    public function viewBillingSetup($id)
    {
        $view_billing_setup = BillingSetup::find($id);
        $view_details = BillingSetup::with('relBatch', 'relBatch.relDegree','relBatch.relDegree.relDegreeProgram')
            ->where('id', '=', $id)
            ->first();
        return View::make('fees::billing_setup.view',compact('view_billing_setup','view_details'));
    }

    public function editBillingSetup($id)
    {
        $edit_billing_setup = BillingSetup::find($id);
        $degree_program_name= BillingSetup::with('relBatch', 'relBatch.relDegree','relBatch.relDegree.relDegreeProgram')
            ->where('id', '=', $id)
            ->first();

        $degree = ['' => 'Please Select Degree to Edit'] + DegreeProgram::lists('title', 'id');
        $batch_id = ['' => 'Select Batch']+ Batch::lists('batch_number', 'id');
        $schedule_id = ['' => 'Select Billing Schedule']+ BillingSchedule::lists('title', 'id');
        $item_id = ['' => 'Select Billing Item']+ BillingItem::lists('title', 'id');

        return View::make('fees::billing_setup.edit',compact('edit_billing_setup','degree','batch_id','schedule_id','item_id','degree_program_name'));
    }

    public function updateBillingSetup($id)
    {
        if($this->isPostRequest()) {
            $data = Input::all();
            $model = BillingSetup::find($id);
            if ($model->validate($data)) {
                DB::beginTransaction();
                try {
                    $model->billing_schedule_id = Input::get('schedule_id');
                    $model->billing_item_id = Input::get('item_id');
                    $model->batch_id = Input::get('batch_id');
                    $model->cost = Input::get('cost');
                    $model->deadline = Input::get('deadline');
                    $model->fined_cost = Input::get('fined');
                    $model->save();
                    DB::commit();
                    Session::flash('message', "Billing is Setup Successfully");
                    return Redirect::back();
                }
                catch ( Exception $e ){
                    //If there are any exceptions, rollback the transaction
                    DB::rollback();
                    Session::flash('danger', "not added.Invalid Request!");
                }
                return Redirect::back();
            } else {
                $errors = $model->errors();
                Session::flash('errors', $errors);
                return Redirect::back()
                    ->with('errors', 'invalid');
            }
        }

        return Redirect::back();
    }

    public function deleteBillingSetup($id)
    {
        try {
            $data= BillingSetup::find($id);
            if($data->delete())
            {
                Session::flash('message', "Billing setup Item Deleted");
                return Redirect::back();
            }
        }
        catch
        (exception $ex){
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');

        }
    }

    /***
     * @author Ratna
     * @param $id
     *
    */
    public function batchdeleteBillingSetup($id)
    {
        try {
            BillingSetup::destroy(Request::get('id'));
            Session::flash('message', "Success: Selected items Deleted ");
            return Redirect::back();
        }
        catch
        (exception $ex){
            return Redirect::back()->with('error', 'Invalid Delete Process ! At first Delete Data from related tables then come here again. Thank You !!!');
        }
    }

    /**********************Billing History Start***************************/

	public function index_billing_history()
	{
        $degree = ['' => 'Select Degree'] + DegreeProgram::lists('title', 'id');
        $batch = ['' => 'Select Batch']+ Batch::lists('batch_number', 'id');
        $department = ['' => 'Select Department']+ Department::lists('title', 'id');

        $department_id = Input::get('department_id');
        $degree_id = Input::get('degree_id');
        $batch_id = Input::get('batch_id');
        $studentOrApplicant = Input::get('studentOrApplicant');
        $student_id  = Input::get('student_id');
        $name  = Input::get('student_name');

        Input::flash();

        if($studentOrApplicant == 'student'){

            $q = new BillingVStudentHistory();

            if (!empty($department_id)) {
                $q = $q->where('department_id', '=', $department_id);
            }

            if (!empty($degree_id)) {
                $q = $q->where('degree_id', '=', $degree_id);
            }

            if (!empty($batch_id)) {
                $q = $q->where('batch_id', '=', $batch_id);
            }

            if (!empty($name)) {
                $q = $q->where('first_name', 'like', "%$name%");
                $q = $q->orWhere('last_name', 'like', "%$name%");
            }
            if (!empty($student_id)) {
                $q->where('student_id', '=', $student_id);
            }

        }else {
            $q = new BillingVApplicantHistory();

            if (!empty($department_id)) {
                $q = $q->where('department_id', '=', $department_id);
            }

            if (!empty($degree_id)) {
                $q = $q->where('degree_id', '=', $degree_id);
            }

            if (!empty($batch_id)) {
                $q = $q->where('batch_id', '=', $batch_id);
            }

            if (!empty($name)) {
                $q = $q->where('first_name', 'like', "%$name%");
                $q = $q->orWhere('last_name', 'like', "%$name%");
            }
        }
        $data = $q->get();
        //$queries = DB::getQueryLog();
        //$last_query = end($queries);
        //dd(DB::getQueryLog());
        //print_r($data);exit;

        return View::make('fees::billing_history.index',compact('degree','batch','department','applicant','student','studentOrApplicant','data'));

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function billing_history_show($id)
	{

            $student_info = BillingVStudentHistory::where('id', $id)->first();
            // print_r($student_info);exit;
            $student_details = BillingVStudentHistory::find($id);

            $applicant_info = BillingVApplicantHistory::where('id', $id)->first();
            $applicant_details = BillingVApplicantHistory::find($id);


            return View::make('fees::billing_history.view',compact('student_info','student_details','applicant_info','applicant_details'));
	}

}
