<?php
class AcmAcademic extends \Eloquent
{
    protected $fillable = [];
    protected $table = 'acm_academic';

    public function relAcmMarksDistribution()
    {
        return $this->belongsTo('AcmMarksDistribution','acm_marks_distribution_id','id');
    }
    public function relAcmClassSchedule()
    {
        return $this->belongsTo('AcmClassSchedule','acm_class_schedule_id','id');
    }

//validation for save_marksdist_item_class_data method

    private $errors;
    // 1 Create data validation
    private $rules = array(
        'title' => 'required|alpha_spaces|min :3',
        'description'=>'required|alpha_spaces|min :3'
          // 'file' => 'required|mimes:png,gif,jpeg'
          //'photo' => 'mimes:jpeg,bmp,png'

    );

    public function validate($data)
    {
        // make a new validator object
        $validate = Validator::make($data, $this->rules);
        // check for failure
        if ($validate->fails()) {
            // set errors and return false
            $this->errors = $validate->errors();
            return false;
        }
        // validation pass
        return true;
    }

    // 2 update data validation

    private $rules2 = array(
        'title' => 'required|min :3',
        'description'=>'required|min :3'
//        'file' => 'required|mimes:png,gif,jpeg'

    );

    public function validate2($data)
    {
        // make a new validator object
        $validate = Validator::make($data, $this->rules2);

        // check for failure
        if ($validate->fails()) {
            // set errors and return false
            $this->errors = $validate->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }


}