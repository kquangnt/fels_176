@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('user.detail_user') }} </div>
                <div class="panel-body">
                    @include('admin.user.show_fields')
                    <a href="{!! route('admin.user.index') !!}" class="btn btn-default">{{ trans('user.back') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
