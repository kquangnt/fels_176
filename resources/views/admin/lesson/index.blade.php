@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('lesson.list_lesson') }} </div>
                <a class="btn btn-primary pull-right" href="{!! route('admin.lesson.create') !!}">{{ trans('lesson.add_lesson') }}</a>
                <div class="panel-body">
                    @include('admin.layouts.partials.success')
                    @include('admin.layouts.partials.errors')
                    <div class="box box-primary">
                        <div class="box-body">
                            @include('admin.lesson.table')
                        </div>
                    </div>
                    {!! $lessons->render(); !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
