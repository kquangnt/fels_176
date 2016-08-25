@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('word.word') }} </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.word.store', 'method' => 'POST']) !!}

                        @include('admin.word.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
