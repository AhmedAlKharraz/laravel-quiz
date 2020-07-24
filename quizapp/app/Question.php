<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;
use App\Quiz;

class Question extends Model
{
    protected $fillable = ['question', 'quiz_id', 'background'];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function storeQuestion($data){
        //quiz_id comes from the table, but quiz alone comes from the form
        //so if there is a diffirance in the name between the from and table we have to create this line, otherwise no need
        $data['quiz_id'] = $data['quiz'];

        $image = $data->file('question-background');
        $imageName = time(). '.' .$image->getClientOriginalExtension();
        $destinationPath = public_path('/question_images');
        $image->move($destinationPath, $imageName);

        $data['background'] = $data[$imageName];

        return Question::create($data);
    }
}
