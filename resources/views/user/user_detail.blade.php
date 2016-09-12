@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.user_detail') }}</div>
                <div class="panel-body user-detail">
                    <img src="{{ $userDetail->getAvatarPath() }}" alt="User Image">
                    <br><br>
                    <table>
                        <tr>
                            <td>
                                <strong> {{ trans('label.name') }}: </strong>
                            </td>

                            <td>
                                <label class="user-detail"> {{ $userDetail->name }} </label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong> {{ trans('label.created') }}: </strong>
                            </td>

                            <td>
                                <label class="user-detail"> {{ $userDetail->created_at->diffForHumans() }} </label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong> {{ trans('label.email') }}: </strong>
                            </td>

                            <td>
                                <label class="user-detail"> {{ $userDetail->email }} </label>
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <strong> {{ trans('label.followed') }}: </strong>
                            </td>

                            <td>
                                <label class="user-detail"> {{ count($userDetail->followers) }} </label>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <a href="{{ url('/home') }}" class="btn btn-default">{{ trans('label.back') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
