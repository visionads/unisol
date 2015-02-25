<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class DegreeWaiver extends Eloquent{

    protected $table='degree_waiver';


    public function relWaiver(){
        return $this->belongsTo('Waiver', 'waiver_id', 'id');
    }
    public function relDegree(){
        return $this->belongsTo('Degree', 'degree_id', 'id');
    }


} 