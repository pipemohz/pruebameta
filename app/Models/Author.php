<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Author extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];


    public static $rules = array(
        'name' => 'required|string|alpha',
        );

    public static $messages = array(

        'required' => 'Agregue un nombre.',
        'alpha' => 'El nombre debe contener solo caracteres alfabeticos',
        
    
    );

    public static function validate($data)
    {
        $reglas = self::$rules;
        return Validator::make($data, $reglas,self::$messages);
    }

    public function books()
    {
        return $this->hasMany(Book::class,'author_id','id');
    }
}
