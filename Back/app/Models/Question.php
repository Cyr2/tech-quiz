<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $fillable = ['question_id','label', 'quiz_id'];
    public $timestamps = true;
}
