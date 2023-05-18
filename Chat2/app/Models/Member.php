<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Memberクラス
 */
class Member extends Model
{
    protected $guarded=array('id');

    public static $rules=array(
        'name'=>'required|max:255',
        'mail'=>'required|max:255', //本当は 'required'じゃなくて 'email'
        'password'=>'required|min:5|max:20',
        'image'=>'',

    );

    public function getData(){
        return $this->id.':'.$this->name;
    }
}
