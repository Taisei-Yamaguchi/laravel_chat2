<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Post extends Model
{
    protected $guarded=array('id');
    public static $rules=array(
        'message'=>'required|max:100',
    );

    public function member(){
        return $this->belongsTo('App\Models\Member');
    }

    public function getData(){
        return $this->id.':'.$this->message.'('.$this->member->name.')';
    }
}
