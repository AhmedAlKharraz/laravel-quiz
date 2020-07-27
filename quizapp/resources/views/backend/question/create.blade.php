@extends('backend.layouts.master')
    @section('title', 'create quiz')
    @section('content')
    <div class="span9">
        <div class="content">

        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
            <form action="{{route('question.store')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="module">
                    <div class="module-head">
                        <h3>Create quiz</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">

                            <label for="" class="control-label">Choose quiz</label>
                            <div class="controls">
                                <select name="quiz" id="" class="span8">
                                    @foreach(App\Quiz::all() as $quiz)
                                    <option value="{{$quiz->id}}">{{$quiz->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="" class="control-label">Question name</label>
                            <div class="controls">
                                <input type="text" name="question" class="span8" placeholder="name of a question"
                                value="{{old('question')}}">
                                @error('quiestion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="" class="control-label">Quiestion image</label>
                            <div class="controls">
                                <input type="file" name="question-background" class="span8">
                                @error('question-background')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <br><br>

				            <label class="control-lable" for="options">Options</label>
				                <div class="controls">
                                    @for($i=0;$i<4;$i++)
                                        <input type="text" name="options[]" class="span7 @error('name') border-red @enderror" placeholder=" options{{$i+1}}" required="" ><br>
                                        <input type="file" name="options-img[]" class="span8"><br>
                                        <input type="radio" name="correct_answer" value="{{$i}}"><span> Is correct answer</span><br>
                                    @endfor
                                    </div>
                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @error('options')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @error('options-img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            <br>
                            <div class="controls">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
