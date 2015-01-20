<?php

class Course extends \Eloquent
{
    protected $table = 'course';

    private $errors;
    // 1
    private $rules = array(
        'title' => 'required|unique:degree_level',
        'course_code'  => 'required',
        'subject_id'  => 'required',
        'description'  => 'required',
        'course_type'  => 'required',
        'evaluation_total_marks'  => 'required',
        'credit'  => 'required',
        'hours_per_credit'  => 'required',
        'cost_per_credit'  => 'required',

    );


    public function validate($data)
    {
        // make a new validator object
        $validate = Validator::make($data, $this->rules);
        // check for failure
        if ($validate->fails())
        {
            // set errors and return false
            $this->errors = $validate->errors();
            return false;
        }
        // validation pass
        return true;
    }

    // 2

    private $rules2 = array(
        'title' => 'required',
        'course_code'  => 'required',
        'subject_id'  => 'required',
        'description'  => 'required',
        'course_type'  => 'required',
        'evaluation_total_marks'  => 'required',
        'credit'  => 'required',
        'hours_per_credit'  => 'required',
        'cost_per_credit'  => 'required',

    );

    public function validate2($data)
    {
        // make a new validator object
        $validate = Validator::make($data, $this->rules2);
        // check for failure
        if ($validate->fails())
        {
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
?>