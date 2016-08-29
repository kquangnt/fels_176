@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.profile') }}</div>
                <div class="panel-body">

                    {{ Form::model($user, ['method' => 'PATCH', 'route' => ['user.user.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'files' => true]) }}

                        <img id="output" src="{{ asset($user->getAvatarPath()) }}"/>

                        <div class="form-group">
                             {{ Form::label('avatar', trans('label.avatar'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::file('avatar', Input::old('avatar')) }}

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                         </div>

                         <div class="form-group">
                             {{ Form::label('name', trans('label.name'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('name', Input::old('name'), ['class' => 'form-control']) }}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                         </div>

                         <div class="form-group">
                             {{ Form::label('email', trans('label.email_address'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::email('email', Input::old('email'), ['class' => 'form-control', 'name' => 'email']) }}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                             </div>
                         </div>

                         <div class="form-group">
                             {{ Form::label('password', trans('label.password'), ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                 {{ Form::password('password', ['class' => 'form-control', 'name' => 'password']) }}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                             </div>
                         </div>

                         <div class="form-group">
                         {{ Form::label('email', trans('passwords.confirm_password'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                {{ Form::password('password', ['class' => 'form-control', 'name' => 'password_confirmation']) }}

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                              </div>
                         </div>

                         <div class="form-group">
                             <div class="col-md-6 col-md-offset-4">
                                 <button type="submit" class="btn btn-primary">
                                     <i class="fa fa-btn fa-user"></i> {{ trans('label.edit') }}
                                 </button>
                             </div>
                         </div>
                      {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
