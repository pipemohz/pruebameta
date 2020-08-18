<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Book extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'author_id','publish_date','title',
    ];

    public static $rules = array(
        'author_id' => 'required|min:1|numeric',
        'title' => 'required|unique:books|max:30',
        'publish_date' => 'required|date',
        
     );

    public static $messages = array(

        'required' => 'Falta uno o varios atributos.',
        'numeric' => 'Debe ser un entero',
        'title.unique'=> 'Ya hay un titulo con el mismo nombre',
        'publish_date.date' => 'Debe ser una fecha',
 
    );

     public static function validate($data){

       
        $reglas = self::$rules;
        return Validator::make($data, $reglas,self::$messages);
     }


    public function author(){
        return $this->hasOne(Author::class,'id','author_id');

    }

}
