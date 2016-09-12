@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('lesson.detail_lesson') }} </div>
                <div class="panel-body">
                    @include('admin.lesson.show_fields')
                    <a href="{!! route('admin.lesson.index') !!}" class="btn btn-default">{{ trans('lesson.back') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
