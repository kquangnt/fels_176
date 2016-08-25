@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ trans('category.edit_category') }} </div>
                <div class="panel-body">
                    {!! Form::model($category, ['route' => ['admin.category.update', $category->id], 'method' => 'PUT']) !!}

                        @include('admin.category.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
