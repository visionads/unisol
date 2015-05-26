<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class LibBook extends Eloquent{

    //TODO :: model attributes and rules and validation
    protected $table='lib_books';
    protected $fillable = [
        'title','isbn','lib_book_category_id','lib_book_author_id','lib_book_publisher_id','edition','stock_type','shelf_number','book_type','commercial','file','book_price','digital_sell_price','is_rented'
    ];
    private $errors;
    private $rules = [
        'title' => 'required',
        'lib_book_category_id' => 'required|integer',
        'lib_book_author_id' => 'required|integer',
        'lib_book_publisher_id' => 'required|integer',
        'edition' => 'required',
        'stock_type' => 'required',
        'shelf_number' => 'required',
        'book_type' => 'required',
        'commercial' => 'required',
        'file' => 'required',
        'book_price' => 'required',
        'digital_sell_price' => 'required',
        'is_rented' => 'required',
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

    public function relLibBookCategory(){
        return $this->belongsTo('LibBookCategory','lib_book_category_id','id');
    }
    public function relLibBookAuthor(){
        return $this->belongsTo('LibBookAuthor','lib_book_author_id','id');
    }
    public function relLibBookPublisher(){
        return $this->belongsTo('LibBookPublisher','lib_book_publisher_id','id');
    }

    /* public function relBatchCourse(){
         return $this->HasMany('BatchCourse');
     }*/


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