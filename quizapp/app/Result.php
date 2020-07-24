<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Result extends Model
{
    protected $fillable = ['question_id', 'quiz_id', 'answer_id'];

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
