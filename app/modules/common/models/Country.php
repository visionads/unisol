<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Country  extends Eloquent{
    protected $table = 'country';


    public static function country_lists(){
        $result = Country::lists('title', 'id');
        return $result;
    }

} 