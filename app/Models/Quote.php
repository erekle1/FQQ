<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['quote'];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class,'quote_answers');
    }
}
