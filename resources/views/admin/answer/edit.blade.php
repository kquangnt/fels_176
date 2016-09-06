@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('answer.edit_answer') }} </div>
                <div class="panel-body">
                    {{ Form::model($answer, ['route' => ['admin.answer.update', $answer->id], 'method' => 'PUT']) }}

                        @include('admin.answer.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
