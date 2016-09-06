@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('answer.detail_answer') }} </div>
                <div class="panel-body">
                    @include('admin.answer.show_fields')
                    <a href="{!! route('admin.answer.index') !!}" class="btn btn-default">{{ trans('category.back') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
