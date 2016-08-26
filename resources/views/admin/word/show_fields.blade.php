<div class="form-group">
    {!! Form::label('id', trans('word.id')) !!}
    <p>{!! $word['id'] !!}</p>
</div>

<div class="form-group">
    {!! Form::label('content', trans('word.content')) !!}
    <p>{!! $word['content'] !!}</p>
</div>

<div class="form-group">
    {!! Form::label('category_id', trans('word.category')) !!}
    <p>{!! $word->category->name !!}</p>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('word.created_at')) !!}
    <p>{!! $word['created_at'] !!}</p>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('word.updated_at')) !!}
    <p>{!! $word['updated_at'] !!}</p>
</div>
