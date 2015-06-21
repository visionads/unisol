<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class HrEmployee extends Eloquent{

    //TODO :: model attributes and rules and validation
    protected $table='hr_employee';
    protected $fillable = [
        'user_id','employee_id','date_of_joining','date_of_confirmation',
        'hr_salary_grade_id','department_id','designation_id','hr_bank_id',
        'bank_account_no','currency','exchange_rate','employee_type',
        'employee_category','work_shift','emergency_contact_person',
        'emergency_contact_number','emergency_contact_relation','note','status'
    ];
    private $errors;
    private $rules = [
        'user_id' => 'required',
        'employee_id' => 'required',
        'hr_salary_grade_id' => 'required',
        'hr_bank_id' => 'required',
        'department_id' => 'required',
        'designation_id' => 'required'
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



    // TODO : user info while saving data into table
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::user()->check()){
                $query->created_by = Auth::user()->get()->id;
            }elseif(Auth::applicant()->check()){
                $query->created_by = Auth::applicant()->get()->id;
            }
        });
        static::updating(function($query){
            if(Auth::user()->check()){
                $query->updated_by = Auth::user()->get()->id;
            }elseif(Auth::applicant()->check()){
                $query->updated_by = Auth::applicant()->get()->id;
            }
        });
    }


    //TODO : Scope Area

}