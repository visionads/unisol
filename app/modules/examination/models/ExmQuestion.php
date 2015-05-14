<?php

class ExmQuestion extends \Eloquent
{
    //TODO :: model attributes and rules and validation
    protected $table = 'exm_question';
    protected $fillable = [
        'exm_exam_list_id', 'course_conduct_id', 'examiner_faculty_user_id', 'title','deadline',
        'total_marks', 'status',
    ];

    private $errors;
    private $rules = [
        'exm_exam_list_id' => 'required|integer',
        'course_conduct_id' => 'required|integer',
        's_faculty_user_id' => 'integer',
        'e_faculty_user_id' => 'integer',
        'title' => 'required',
        'deadline' => 'required',
        'total_marks' => 'required',

        //'status' => 'required|integer',
    ];

    public function validate($data)
    {
        $validate = Validator::make($data, $this->rules);
        if ($validate->fails())
        {
            $this->errors = $validate->errors();
            return false;
        }
        return true;
    }
    public function errors()
    {
        return $this->errors;
    }


    //TODO : Model Relationship
    public function relExmQuestionItems(){
        return $this->HasMany('ExmQuestionItems');
    }
    public function relExmQuestionComments(){
        return $this->HasMany('ExmQuestionComments');
    }

    public function relCourseConduct(){
        return $this->belongsTo('CourseConduct', 'course_conduct_id', 'id');
    }
    public function relSUser(){
        return $this->belongsTo('User', 's_faculty_user_id', 'id');
    }
    public function relEUser(){
        return $this->belongsTo('User', 'e_faculty_user_id', 'id');
    }
    public function relExmExamList(){
        return $this->belongsTo('ExmExamList', 'exm_exam_list_id', 'id');
    }

    // TODO : user info while saving data into table
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::user()->check()){
                $query->created_by = Auth::user()->get()->id;
            }
        });
        static::updating(function($query){
            if(Auth::user()->check()){
                $query->updated_by = Auth::user()->get()->id;
            }
        });
    }


    //TODO : Scope Area




}
