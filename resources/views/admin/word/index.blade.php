@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('word.list_word') }} </div>
                <a class="btn btn-primary pull-right" href="{!! route('admin.word.create') !!}">{{ trans('word.add_word') }}</a>
                <div class="panel-body">
                    @include('admin.layouts.partials.success')
                    @include('admin.layouts.partials.errors')
                    <div class="box box-primary">
                        <div class="box-body">
                            @include('admin.word.table')
                        </div>
                    </div>
                    {!! $words->render(); !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
