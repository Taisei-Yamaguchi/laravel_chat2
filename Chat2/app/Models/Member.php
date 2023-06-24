<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Memberクラス
 */
class Member extends Model
{
    protected $connection = 'chat';
    protected $guarded=array('id');

    public static $rules=array(
        'name'=>'required|max:255',
        'mail'=>'required|max:255', //本当は 'required'じゃなくて 'email'
        'password'=>'required|min:5|max:20',
        'image'=>'required',

    );

    public static $rules_integrate=array(
        'mail'=>'required|max:255', //本当は 'required'じゃなくて 'email'
        'password'=>'required|min:5|max:20',

    );

    public function getData(){
        return $this->id.':'.$this->name;
    }
}
