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
                                {{ $userDetail->name }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong> {{ trans('label.created') }}: </strong>
                            </td>

                            <td>
                                {{ $userDetail->created_at->diffForHumans() }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong> {{ trans('label.email') }}: </strong>
                            </td>

                            <td>
                                {{ $userDetail->email }}
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <strong> {{ trans('label.followed') }}: </strong>
                            </td>

                            <td>
                                {{ count($userDetail->followers) }}
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
