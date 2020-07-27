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

        /* foreach($data['options'] as $key=>$option){
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
        ]); */


        $imageName = $data['options-img'];
        if($data->hasFile('options-img')){
            foreach($data['options-img'] as $key => $image)
            {
                $is_correct = false;
                if($key == $data['correct_answer']){
                    $is_correct = true;
                }
                $imageName = time(). '.' .$image->getClientOriginalExtension();
                $destinationPath = public_path('/question_images');
                $image->move($destinationPath, $imageName);
                $answer = \App\Answer::create([
                    'question_id'=>$question->id,
                    'answer'=>$data['options'][$key],
                    'background'=>$imageName,
                    'is_correct'=>$is_correct
                ]);
            }
        }
    }

    public function updateAnswer($data,$question){
        $this->deleteAnswer($question->id);
        $this->storeAnswer($data,$question);
    }

    public function deleteAnswer($questionId){
        Answer::where('question_id',$questionId)->delete();
    }

}
