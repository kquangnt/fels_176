@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.result') }}</div>
                <div class="panel-body">
                    <strong> {{ $categoryName }} </strong>
                    <label> {{ trans('label.correct') }} {{ $countCorrect }} / {{ config('settings.count_question') }} </label>
                    <br><br>
                    <div class="wrapper-question">
                        @foreach ($words as $word)
                            <div>
                                <h3> {{ $word->content }} </h3>
                                <button type="button" class="btn btn-success">{{ trans('label.speak') }}</button>
                                <br><br>
                            </div>
                            <div>
                                @foreach ($word->answers as $answer)
                                    {{ $answer->content }}
                                    @foreach ($results as $key => $value)
                                        @if ($answer->id == $value)
                                            <strong> [{{ trans('label.you_choosed') }}] </strong>
                                        @endif
                                    @endforeach

                                    @if ($answer->is_correct)
                                        <strong> [{{ trans('label.correct') }}] </strong>
                                    @endif

                                    <br>
                                @endforeach
                            </div>
                        @endforeach
                        {!! Form::close() !!}
                        <br><br>
                        <a href="{{ URL::action('HomeController@index') }}" class="btn btn-default">{{ trans('label.back') }}</a>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
