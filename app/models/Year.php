<?php

class Year extends \Eloquent 
{
	protected $fillable = [];
	protected $table = 'year';


//	public function coursemanagement(){
//		return $this->belongsTo('CourseManagement');
//	}
	// ratna code
    public static function getYearsName($yearId){
    $data = Year::find($yearId);
	return $data->title;
	}
}
?>

