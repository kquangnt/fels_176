@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('word.word_list') }}</div>
                <div class="panel-body">
                    <center>
                        {!! Form::open(['action' => 'User\FilterController@filterWord', 'role' => 'form']) !!}
                            <div class="form-group">
                                {!! Form::label(trans('label.category')) !!}
                                @if (isset($selectedCategory) && !empty($selectedCategory))
                                    {!! Form::select('optCategory', $categories->toArray(), $selectedCategory->id) !!}
                                @else
                                    {!! Form::select('optCategory',  ['' => trans('label.select')] + $categories->toArray(), null) !!}
                                @endif
                                {!! Form::radio('rdLearned', trans('label.learned'), isset($rdChoose) && $rdChoose === config('settings.learned') ? true : null) !!}
                                {{ trans('label.learned') }}

                                {!! Form::radio('rdLearned', trans('label.not_learned'), isset($rdChoose) && $rdChoose === config('settings.not_learned') ? true: null) !!}
                                {{ trans('label.not_learned') }}

                                {!! Form::radio('rdLearned', trans('label.all'), isset($rdChoose) && $rdChoose === config('settings.all') ? true : null) !!}
                                {{ trans('label.all') }}

                                <br>
                                {!! Form::submit(trans('label.filter'), ['class' => 'btn btn-info']) !!}
                                {!! Form::submit(trans('label.pdf'), ['class' => 'btn btn-info']) !!}
                            </div>

                        <div class="panel-body">
                            <table>
                                @foreach ($words as $word)
                                    <tr>
                                        <td>
                                            <label class="display-content"> {{ $word->content }} </label>
                                        </td>
                                        @foreach ($word->answers as $answer)
                                            @if ($answer->is_correct)
                                                <td>
                                                    <label class="display-content"> {{ $answer->content }} </label>
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        {!! Form::close() !!}
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
