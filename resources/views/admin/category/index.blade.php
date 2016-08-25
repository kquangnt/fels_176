@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('category.list_category') }} </div>
                <a class="btn btn-primary pull-right" href="{!! route('admin.category.create') !!}">{{ trans('category.add_category') }}</a>
                <div class="panel-body">
                    @include('admin.layouts.partials.success')
                    @include('admin.layouts.partials.errors')
                    <div class="box box-primary">
                        <div class="box-body">
                            @include('admin.category.table')
                        </div>
                    </div>
                    {!! $categories->render(); !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
