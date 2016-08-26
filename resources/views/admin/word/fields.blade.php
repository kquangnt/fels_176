@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

<div class="form-group col-sm-6">
    {!! Form::label('content', trans('word.content')) !!}
    {!! Form::text('content', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('category_id', trans('word.category')) !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit(trans('word.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.word.index') !!}" class="btn btn-default">{{ trans('word.back') }}</a>
</div>
