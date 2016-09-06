@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('user.edit_user') }} </div>
                <div class="panel-body">
                    {{ Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'PUT', 'files' => true]) }}

                        @include('admin.user.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
