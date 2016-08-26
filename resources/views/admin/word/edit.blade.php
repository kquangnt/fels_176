@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('word.edit_word') }} </div>
                <div class="panel-body">
                    {!! Form::model($word, ['route' => ['admin.word.update', $word->id], 'method' => 'PUT']) !!}

                        @include('admin.word.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
