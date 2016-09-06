@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

<div class="form-group col-sm-6">
    {!! Form::label('word_id', trans('answer.word')) !!}
    {!! Form::select('word_id', $words, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('content', trans('answer.content')) !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('is_correct', trans('answer.correct')) !!}
    {!! Form::text('is_correct', false, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit(trans('label.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.answer.index') !!}" class="btn btn-default">{{ trans('answer.cancel') }}</a>
</div>
