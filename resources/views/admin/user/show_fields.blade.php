<div class="form-group">
    {!! Form::label('id', trans('user.id')) !!}
    <p>{!! $user->id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('name', trans('user.name')) !!}
    <p>{!! $user->name !!}</p>
</div>

<div class="form-group">
    {!! Form::label('email', trans('user.email')) !!}
    <p>{!! $user->email !!}</p>
</div>

<div class="form-group">
    {!! Form::label('role', trans('user.role')) !!}
    <p>{!! !$user->role ? trans('user.user') : trans('user.admin') !!}</p>
</div>

<div class="form-group">
    {!! Form::label('avatar', trans('user.avatar')) !!}
    <p><img src="{{ $user->getAvatarPath() !!}"></p>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('user.created_at')) !!}
    <p>{!! $user->created_at !!}</p>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('user.updated_at')) !!}
    <p>{!! $user->updated_at !!}</p>
</div>
