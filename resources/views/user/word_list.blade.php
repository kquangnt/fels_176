@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('word.word_list') }}</div>
                <div class="panel-body">
                     <center>
                        {{ Form::open(array('role' => 'form')) }}
                        <div class="form-group">

                            {{ Form::label(trans('word.category')) }}
                            {{ Form::select('optCategory', $categories) }}
                            <br>

                            {{ Form::radio('rdLearned', trans('word.learned')) }} {{ trans('word.learned') }}

                            {{ Form::radio('rdLearned', trans('word.not_learned')) }} {{ trans('word.not_learned') }}

                            {{ Form::radio('rdLearned', trans('word.all'), true) }} {{ trans('word.all') }}

                            <br>
                            {{ Form::submit(trans('word.filter'), array('class' => 'btn btn-info')) }}
                            {{ Form::submit(trans('word.pdf'), array('class' => 'btn btn-info')) }}
                        </div>
                      </form>

                      <div class="panel-body">
                          @foreach ($words as $word)
                          <br>
                               {{ $word->content }}
                                @foreach ($word->answers as $answer)
                                    @if ($answer->is_correct)
                                        {{ $answer->content }}
                                    @endif
                                @endforeach
                          @endforeach
                      </div>
                      {{ Form::close() }}
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
