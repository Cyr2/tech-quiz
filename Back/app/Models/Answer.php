<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /* Attributs d'une réponse */
    protected $table = 'answer';
    protected $fillable = ['answer_id','label', 'is_correct', 'question_id'];
    public $timestamps = true;
    protected $primaryKey = 'answer_id';
    public $incrementing = true;
    protected $keyType = 'int';
}
