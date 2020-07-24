<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Quiz extends Model
{
    protected $fillable = ['name', 'background'];

    //This is the relationship and mean that the quiz have many questions
    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function getQuizById($id){
        return Quiz::find($id);
    }

    public function allQuiz(){
    	return Quiz::all();
    }

    public function updateQuiz($data, $id){
        return Quiz::find($id)->update($data);
    }


}
