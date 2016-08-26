@extends('layouts.app')

@section('profile')
    <div>
         <img class="image-profile" src="{{ Auth::user()->getAvatarPath() }}" class="user-image" alt="User Image">
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
                            <br>
                            @foreach ($lessons as $lesson)
                                <img class="image-profile" src="{{ $lesson->user->getAvatarPath() }}" class="user-image" alt="User Image">
                                <strong> {{ $lesson->user->name }} </strong>
                                {{ trans('label.learned') }}
                                {{ count($lesson->category->words->intersect($listLearnedWord)) }} {{ trans('label.word_in_lesson') }} "{{ $lesson->category->name }}"
                                - ({{ $lesson->created_at }})

                                @if (!$lesson->user->isCurrent())
                                    {!! Form::open(['route' => ['user.relationship.destroy', Auth::user()->id, 'follower_id' => $lesson->user->id], 'method' => 'DELETE']) !!}

                                    {!! Form::submit(trans('label.unfollow'), ['class' => 'btn btn-info', 'onclick' => "return confirm(trans('label.confirm_delete'))"]) !!}

                                    {!! Form::close() !!}
                                @endif
                            <br> <br>
                            @endforeach
                    </div>
                    {!! $lessons->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
