@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.word_list') }}</div>

                <div class="panel-body">

                     <center>
                        <form role="form">
                        <div class="form-group">
                          <label for="sel1">{{ trans('label.category') }}</label>
                          <select id="sel1">
                                <!-- Load categories and display in option -->
                                <option> {{ trans('label.select') }} </option>
                          </select>
                          <br>
                          <input type="radio" name="learned" value="learned"> {{ trans('label.learned') }}
                          <input type="radio" name="learned" value="not learn"> {{ trans('label.not_learned') }}
                          <input type="radio" name="learned" checked value="all"> {{ trans('label.all') }}
                          <br>
                          <button type="button" class="btn btn-info">{{ trans('label.filter') }}</button>
                          <button type="button" class="btn btn-info">{{ trans('label.pdf') }}</button>
                        </div>
                      </form>
                    </center>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
