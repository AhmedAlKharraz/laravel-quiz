<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\Answer;

class Answer extends Model
{
    protected $fillable = ['question_id', 'answer', 'is_correct', 'background'];

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function answer(){
        return $this->belongsTo(Answer::class);
    }

    public function storeAnswer($data, $question){

        foreach($data['options'] as $key=>$option){
            $is_correct = false;
            if($key == $data['correct_answer']){
                $is_correct = true;
            }
        }

        if($data->hasfile('options-img')){
            foreach($data['options-img'] as $image)
            $imageName = time(). '.' .$image->getClientOriginalExtension();
            $destinationPath = public_path('/question_images');
            $image->move($destinationPath, $imageName);
        }
        $answer = Answer::create([
            'question_id'=>$question->id,
            'answer'=>$option,
            'background'=>$imageName,
            'is_correct'=>$is_correct
        ]);
    }
}
