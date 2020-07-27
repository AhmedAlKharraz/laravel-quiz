<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\Answer;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = (new Question)->getQuestions();
        return view('backend.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizes = (new Quiz)->allQuiz();
        return view('backend.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $this->validate($request,[
            'quiz'=>'required',
            'question'=>'required',
            'question-background'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'options'=>'bail|required|array',
            'options.*'=>'bail|required|string|distinct',
            'options-img'=>'bail|required',
            'options-img.*'=>'bail|required|image|mimes:jpeg,png,jpg,gif,svg',
            'correct_answer'=>'required'
        ]);
        
        /////////////////
        $image = $request->file('question-background');
        $imageName = time(). '.' .$image->getClientOriginalExtension();
        $destinationPath = public_path('/question_images');
        $image->move($destinationPath, $imageName);

        Question::create([
            'question'=>$request->get('question'),
            'quiz_id'=>$request->get('quiz'),
            'background'=>$imageName
        ]);

        /////////////////

        foreach($request['options'] as $key=>$option){
            $is_correct = false;
            if($key == $request['correct_answer']){
                $is_correct = true;
            }
        }

        if($request->hasfile('options-img')){
            foreach($request['options-img'] as $image){
                $imageNameOpt = time(). '.' .$image->getClientOriginalExtension();
                $destinationPath = public_path('/question_images');
                $image->move($destinationPath, $imageNameOpt);
            }
        }

        $answer = Answer::create([
            'question_id'=>Question::find($id),
            'answer'=>$option,
            'background'=>$imageNameOpt,
            'is_correct'=>$is_correct
        ]);
        */

        //$data = $this->validateForm($request);
        //$question = (new Question)->storeQuestion($data);
        //$answer = (new Answer)->storeAnswer($data, $question);

        ////////////////
        //return redirect()->route('question.create')->with('message', 'Question Created');


        try {
            $this->validate($request, [
                'quiz' => 'required',
                'question' => 'required',
                'question-background' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'options' => 'bail|required|array',
                'options.*' => 'bail|required|string|distinct',
                'options-img' => 'bail|required',
                'options-img.*' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg',
                'correct_answer' => 'required'
            ]);
            $question = (new Question)->storeQuestion($request);
            $answer = (new Answer)->storeAnswer($request, $question);

            return redirect()->route('question.create')->with('message', 'Question Created');
        } catch (\Exception $exception) {
            return redirect()->route('question.create')->with('error', 'Some data is missing!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = (new Question)->getQuestionById($id);
        return view('backend.question.show', compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = (new Question)->findQuestion($id);

        return view('backend.question.edit', compact('question'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
            $this->validate($request, [
                'quiz' => 'required',
                'question' => 'required',
                'question-background' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'options' => 'required|bail|array',
                'options.*' => 'required|bail|string|distinct',
                'options-img' => 'required|bail',
                'options-img.*' => 'required|bail|image|mimes:jpeg,png,jpg,gif,svg',
                'correct_answer' => 'required'
            ]);
            $question = (new Question)->updateQuestion($id, $request);
            $answer = (new Answer)->updateAnswer($request, $question);

            return redirect()->route('question.show', $id)->with('message', 'Question Updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validateForm($request){
        return $this->validate($request,[
            'quiz'=>'required',
            'question'=>'required',
            'question-background'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'options'=>'bail|required|array',
            'options.*'=>'bail|required|string|distinct',
            'options-img'=>'bail|required',
            'options-img.*'=>'bail|required|image|mimes:jpeg,png,jpg,gif,svg',
            'correct_answer'=>'required'
        ]);
    }
}
