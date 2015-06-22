<?php

class HrBankController extends \BaseController {

    function __construct()
    {
        $this->beforeFilter('', array('except' => array('')));
    }

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

//hr_bank
    public function index_hr_bank()
    {
        $pageTitle = 'Bank Lists';
        $model = HrBank::orderBy('id', 'DESC')->paginate(5);
        return View::make('hr::hr.hr_bank.index', compact('model','pageTitle'));
    }

    public function store_hr_bank()
    {
        if($this->isPostRequest()){
            $input_data = Input::all();
            $model = new HrBank();
            if($model->validate($input_data)) {
                DB::beginTransaction();
                try {
                    $model->create($input_data);
                    DB::commit();
                    Session::flash('message', 'Success !');
                } catch (Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', 'Failed !');
                }
            }
        }
        return Redirect::back();

    }



    public function show_hr_bank($id)
    {
        $data = HrBank::findOrFail($id);
        return View::make('hr::hr.hr_bank.view', compact('pageTitle', 'data'));
    }


    public function edit_hr_bank($id)
    {
        if($this->isPostRequest()){
            $input_data = Input::all();
            $model = HrBank::findOrFail($id);
            if($model->validate($input_data)){
                DB::beginTransaction();
                try{
                    $model->update($input_data);
                    DB::commit();
                    Session::flash('message', 'Success !');
                }catch ( Exception $e ){
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', 'Failed !');
                }
            }
            return Redirect::back();
        }else{
            $model = HrBank::findOrFail($id);
            return View::make('hr::hr.hr_bank.edit', compact('model'));
        }
    }


    public function delete_hr_bank($id)
    {
        DB::beginTransaction();
        try{
            HrBank::destroy($id);
            DB::commit();
            Session::flash('message', 'Success !');
        }catch ( Exception $e ){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', 'Failed !');
        }
        return Redirect::back();
    }

    public function batch_delete_hr_bank()
    {
        DB::beginTransaction();
        try{
            HrBank::destroy(Request::get('id'));
            DB::commit();
            Session::flash('message', 'Success !');
        }catch( Exception $e ){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', 'Failed !');
        }
        return Redirect::back();
    }


}
