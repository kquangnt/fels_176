@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('word.detail_word') }} </div>
                <div class="panel-body">
                    @include('admin.word.show_fields')
                    <a href="{!! route('admin.word.index') !!}" class="btn btn-default">{{ trans('word.back') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
