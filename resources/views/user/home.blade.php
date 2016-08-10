@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.home') }}</div>

                <div class="panel-body">
                    <div class="row">
                        <center>
                            <button type="button" class="btn btn-success">{{ trans('label.words') }}</button>
                            <button type="button" class="btn btn-success">{{ trans('label.lesson') }}</button>
                        </center>
                    </div>
                    <div class="activity">
                        <strong> {{ trans('label.activities') }} </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
