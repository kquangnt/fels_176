@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('category.category') }}</div>
                <div class="panel-body">
                    @foreach ($categories as $category)
                        <br>
                            <strong> {{ $category->name }} </strong>
                            <span> {{ trans('category.you_learned') }} {{ count($category->words->intersect($listLearnedWord)) }}/{{ count($category->words) }} </span>
                            <br>
                            <i> ( {{ $category->description }} ) </i>
                            <br><br>
                            @foreach ($category->words as $word)
                                <label class="display-content"> {{ $word->content }} </label>
                            @endforeach
                        <br><br>
                        <a type="button" class="btn btn-success" href="{{ URL::action('User\LessonController@index', array('category_id' => $category->id, 'category_name' => $category->name)) }}" class="btn btn-success">{{ trans('category.start') }}</a>
                        <br><br>
                    @endforeach
                </div>
                <center>
                    {!! $categories->render() !!}
                </center>
            </div>
        </div>
    </div>
</div>
@endsection
