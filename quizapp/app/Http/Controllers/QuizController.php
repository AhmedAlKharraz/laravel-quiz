<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::latest()->get();

        return view('backend.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'name'=>'required',
            'background'=>'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $image = $request->file('background');
        $imageName = time(). '.' .$image->getClientOriginalExtension();
        $destinationPath = public_path('/quiz_images');
        //This code mean it will move the image to the destination path and will name the image with $name
        $image->move($destinationPath, $imageName);

        Quiz::create([
            //First field from Quiz file the second from quiz.blade.php
            'name'=>$request->get('name'),
            'background'=>$imageName
        ]);

        return redirect()->back()->with('message', 'Quiz Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = (new Quiz)->getQuizById($id);
        return view('backend.quiz.edit', compact('quiz'));
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
        //I removed required because everything is optional, no need to update everything
        $this->validate($request,[
            'name',
            'background'=>'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $quiz = Quiz::find($id);
        $imageName = $quiz->background;

        if($request->hasFile('background')){
            $image = $request->file('background');
            $imageName = time(). '.' .$image->getClientOriginalExtension();
            $destinationPath = public_path('/quiz_images');
            $image->move($destinationPath, $imageName);
        }

        $quiz->name = $request->get('name');
        $quiz->background = $imageName;

        $quiz->save();

        return redirect()->route('quiz.index')->with('message', 'Quiz Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
        return redirect()->route('quiz.index')->with('message', 'Quiz Deleted');
    }

}
