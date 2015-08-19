<?php
class AcmClassRoom extends \Eloquent
{
    //TODO :: model attributes and rules and validation
    protected $table = 'acm_class_room';
    protected $fillable = [
        'room_number', 'building_name', 'floor', 'address',
    ];
    private $errors;
    private $rules = [
        'room_number' => 'required',
        'building_name' => 'required',
        //'floor'  => 'required',
        //'address' => 'required',
        //'is_break' => 'required',
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
    public function relAcmClassSchedule(){
        return $this->HasMany('AcmClassSchedule');
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