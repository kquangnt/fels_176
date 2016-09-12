<div class="form-group">
    {!! Form::label('id', trans('lesson.id')) !!}
    <p>{!! $lesson->id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('user_id', trans('lesson.user')) !!}
    <p>{!! $lesson->user->name !!}</p>
</div>

<div class="form-group">
    {!! Form::label('category_id', trans('lesson.category')) !!}
    <p>{!! $lesson->category->name !!}</p>
</div>


<div class="form-group">
    {!! Form::label('created_at', trans('lesson.created_at')) !!}
    <p>{!! $lesson->created_at !!}</p>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('lesson.updated_at')) !!}
    <p>{!! $lesson->updated_at !!}</p>
</div>
