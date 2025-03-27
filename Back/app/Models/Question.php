<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /* Attributs d'une question */
    protected $table = 'question';
    protected $fillable = ['question_id','label', 'quiz_id'];
    public $timestamps = true;
    protected $primaryKey = 'question_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
