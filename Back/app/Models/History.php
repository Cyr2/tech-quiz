<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['history_id','date', 'score', 'user_id', 'quiz_id'];
    public $timestamps = true;
}
