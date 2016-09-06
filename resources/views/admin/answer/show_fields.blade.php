<div class="form-group">
    {!! Form::label('id', trans('answer.id')) !!}
    <p>{!! $answer->id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('word_id', trans('answer.word')) !!}
    <p>{!! $answer->word->content !!}</p>
</div>

<div class="form-group">
    {!! Form::label('content', trans('answer.content')) !!}
    <p>{!! $answer->content !!}</p>
</div>

<div class="form-group">
    {!! Form::label('is_correct', trans('answer.correct')) !!}
    <p>{!! $answer->is_correct !!}</p>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('answer.created_at')) !!}
    <p>{!! $answer->created_at !!}</p>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('answer.updated_at')) !!}
    <p>{!! $answer->updated_at !!}</p>
</div>
