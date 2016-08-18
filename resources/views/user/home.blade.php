@extends('layouts.app')

@section('profile')
    <div style="position:fixed;margin-left:35px;">
         <img class="image-profile" src="{{ Request::root() }}/uploads/images/{{ Auth::user()->avatar }}" class="user-image" alt="User Image" style="width:100px;height:100px;">
         <p><strong> {{ Auth::user()->name }} </strong></p>
         <p> {{ trans('label.learned') }} {{ $sumLearnedWords }} {{ trans('label.words') }} </p>
         <p> {{ trans('label.followed') }} {{ count(Auth::user()->followers) }} </p>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.home') }}</div>

                <div class="panel-body">
                    <div class="row">
                        <center>
                            <a type="button" href="{{ url('user/word_list') }}" class="btn btn-success">{{ trans('label.words') }}</a>
                            <a type="button" class="btn btn-success">{{ trans('label.lesson') }}</a>
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
