@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.lesson') }}</div>
                <div class="panel-body">
                    <strong> {{ $categoryName }} </strong>
                    <br><br>
                    <div class="wrapper-question">
                        {!! Form::open(['action' => ['User\ResultController@store', 'category_name' => $categoryName, 'category_id' => $categoryId], 'role' => 'form']) !!}
                            @foreach ($words as $word)
                                <div>
                                    <h3> {{ $word->content }} </h3>
                                    <button type="button" class="btn btn-success">{{ trans('label.speak') }}</button>
                                    <br><br>
                                </div>
                                <div>
                                    @foreach ($word->answers as $answer)
                                        {!! Form::radio($word->id, $answer->id) !!}
                                        {{ $answer->content }}
                                        <br>
                                    @endforeach
                                </div>
                            @endforeach
                            <br><br>
                            {!! Form::button(trans('label.finish'), ['type' => 'submit', 'class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
