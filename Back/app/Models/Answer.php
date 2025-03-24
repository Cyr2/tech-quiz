<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';
    protected $fillable = ['answer_id','label', 'is_correct', 'question_id'];
    public $timestamps = true;
}
