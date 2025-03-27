<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{   
    /* Attributs d'un quiz */
    protected $table = 'quiz';
    protected $fillable = ['quiz_id','title', 'date'];
    public $timestamps = true;
    protected $primaryKey = 'quiz_id';
    public $incrementing = false;
    protected $keyType = 'string';
}

