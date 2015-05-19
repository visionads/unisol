<?php

class InvPurchaseOrderController extends \BaseController {

    /*
     * POST REQUEST
     */
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    /*
     *  ====================================================================================
     *  Purchase Order Head  Area
     *  =====================================================================================
     */


    /*
     * All data list(s)
     */
    public function index_purchase_order()
    {
        $pageTitle = 'Purchase Order Lists';
        $data = InvRequisitionHead::where('status', '!=','cancel')->latest('id')->paginate('10');
        return View::make('inventory::po_head.index', compact('pageTitle', 'data'));
    }

    /*
     * Store input data into  Requisition table
     *
     */
    public function store_requisition()
    {
        if($this->isPostRequest()){
            $input_data = Input::all();
            $model = new InvRequisitionHead();
            if($model->validate($input_data)) {
                DB::beginTransaction();
                try {
                    $model->create($input_data);
                    DB::commit();
                    Session::flash('message', 'Success !');
                }catch (Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', 'Failed !');
                }
            }
        }
        return Redirect::back();

    }

    /*
     * Show specific model data only
     * $re_id => Requisition head ID
     */
    public function show_requisition($re_id){
        $data = InvRequisitionHead::where('status', '!=','cancel')->find($re_id);
        $req_dt = InvRequisitionDetail::where('inv_requisition_head_id', $data->id)->get();
        return View::make('inventory::requisition_head.show', compact('pageTitle', 'data', 'req_dt'));
    }

    /*
     * edit and update specific model data only
     * $re_id => Requisition ID
     */
    public function edit_requisition($re_id){
        if($this->isPostRequest()){
            $input_data = Input::all();
            $model = InvRequisitionHead::findOrFail($re_id);
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
            $model = InvRequisitionHead::findOrFail($re_id);
            return View::make('inventory::requisition_head.edit', compact('model'));
        }

    }

    /*
     * Delete specific model data only
     * $re_id => Requisition ID
     */
    public function destroy_requisition($re_id){
        $model = InvRequisitionHead::findOrFail($re_id);
        $model->status = 'cancel';
        DB::beginTransaction();
        try{
            $model->save();
            DB::commit();
            Session::flash('message', 'Success !');
        }catch ( Exception $e ){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', 'Failed !');
        }
        return Redirect::back();
    }


    /*
     * Mass / Batch Delete from Product Category Table
     */
    public function batch_delete_requisition()
    {
        DB::beginTransaction();
        try{
            InvRequisitionHead::whereIn('id', Request::get('id'))->update(['status'=> 'cancel']);
            DB::commit();
            Session::flash('message', 'Success !');
        }catch( Exception $e ){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', 'Failed !');
        }
        return Redirect::back();
    }

    /*
     * Create Purchase Order
     */
    public function create_purchase_order($req_id){
        echo $req_id;

        /*$success = DB::select(
            'INSERT INTO inv_purchase_order_head SELECT * FROM inv_requisition_head WHERE inv_requisition_head.id = inv_purchase_order_head.inv_requisition_head_id'
        );*/
    }



    /*
     *  ====================================================================================
     *  Requisition Detail Area
     *  =====================================================================================
     */

    /*
     * detail of requisition item(s)
     */
    public function detail_requisition($req_id){
        $req_head = InvRequisitionHead::find($req_id);
        $req_dt = InvRequisitionDetail::where('inv_requisition_head_id', $req_id)->get();
        return View::make('inventory::requisition_detail.add_edit', compact('req_id', 'req_head', 'req_dt'));
    }

    // AJax Product Search
    public function ajaxGetProductAutoComplete(){

        $term = Input::get('term');
        $results = array();
        $queries = DB::table('inv_product')
            ->where('title', 'LIKE', '%'.$term.'%')
            ->orWhere('code', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        foreach ($queries as $query)
        {
            $results[] = [
                'label' => $query->title.' - '.$query->code ,
                'id' => $query->id,
                'rate'=>$query->cost_price ,
                'unit' =>$query->purchase_unit,
                'name' => $query->title
            ];
        }
        return Response::json($results);
    }


    /*
     * Store Requisition Detail products
     *
     */
    public function store_requisition_detail(){
        $data = Input::all();
        for($i = 0; $i < count(Input::get('inv_product_id')) ; $i++){
            $dt[] = [
                'inv_requisition_head_id' => Input::get('inv_requisition_head_id'),
                'inv_product_id'=> Input::get('inv_product_id')[$i],
                'rate'=> Input::get('rate')[$i],
                'unit'=> Input::get('unit')[$i],
                'quantity'=> Input::get('quantity')[$i],
            ];
        }
        $model = new InvRequisitionDetail();
        DB::beginTransaction();
        try{
            foreach($dt as $values){
                $model->create($values);
            }
            DB::commit();
            Session::flash('message', 'Success !');
        }catch ( Exception $e ){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', 'Failed !');
        }
        return Redirect::back();
    }


    /*
     * $id = Requisition Detail ID
     *
     */
    public function ajax_delete_req_detail($id){
        $id = Input::get('id');
        DB::beginTransaction();
        try{
            InvRequisitionDetail::destroy($id); //Batch::destroy(Request::get('id'));
            DB::commit();
            return Response::json("Successfully Deleted");
        }catch ( Exception $e ){
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            return Response::json("Can not delete !");
        }
    }


}
