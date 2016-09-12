@extends('layouts.app')

@section('profile')
    <div class="user-infor">
         <img class="img-circle image-profile" src="{{ Auth::user()->getAvatarPath() }}" class="user-image" alt="User Image">
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
                <div class="panel-heading">{{ trans('label.user_show') }}</div>
                <div class="panel-body">
                    <br>
                    @foreach ($users as $user)
                        <img class="image-profile" src="{{ $user->getAvatarPath() }}" class="user-image" alt="User Image">
                        [<a href="{{ URL::action('User\UsersController@show', $user->id) }}"> {{ $user->name }} </a>]
                         - {{ trans('label.followed') }} {{ count($user->followers) }}
                        <a type="button" class="btn btn-info" href="{{ URL::action('User\RelationshipsController@create', ['follower_id' => $user->id]) }}">{{ trans('label.follow') }}</a>
                        <br> <br>
                    @endforeach
                </div>
                {!! $users->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
