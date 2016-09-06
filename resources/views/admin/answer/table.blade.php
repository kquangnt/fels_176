<table class="table table-responsive" id="users-table">
    <thead>
        <th>{{ trans('answer.id') }}</th>
        <th>{{ trans('answer.word') }}</th>
        <th>{{ trans('answer.content') }}</th>
        <th>{{ trans('answer.correct') }}</th>
        <th>{{ trans('answer.action') }}</th>
    </thead>
    <tbody>
    @foreach ($answers as $answer)
        <tr>
            <td>{{ $answer->id }}</td>
            <td>{{ $answer->word->content }}</td>
            <td>{{ $answer->content }}</td>
            <td>{{ $answer->is_correct ? trans('answer.correct') : trans('answer.not_correct') }}</td>
            <td>
                {!! Form::open(['route' => ['admin.answer.destroy', $answer->id], 'method' => 'DELETE']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.answer.show', [$answer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.answer.edit', [$answer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm(trans('label.confirm_delete'))"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
