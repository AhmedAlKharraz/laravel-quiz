@extends('backend.layouts.master')
    @section('title', 'create quiz')
    @section('content')
    <div class="span9">
        <div class="content">

        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
            <form action="{{route('quiz.update',[$quiz->id])}}" method="POST" enctype="multipart/form-data">@csrf
                {{method_field('PUT')}}
                <div class="module">
                    <div class="module-head">
                        <h3>Update quiz</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">

                            <label for="" class="control-label">Quiz name</label>
                            <div class="controls">
                                <input type="text" name="name" class="span8" placeholder="name of a quiz"
                                value="{{$quiz->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="" class="control-label">Quiz image</label>
                            <div class="controls">
                                <input type="file" name="background" class="span8">
                                @error('background')
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