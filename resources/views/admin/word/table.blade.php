<table class="table table-responsive" id="users-table">
    <thead>
        <th>{{ trans('word.id') }}</th>
        <th>{{ trans('word.content') }}</th>
        <th>{{ trans('word.category') }}</th>
        <th>{{ trans('word.action') }}</th>
    </thead>
    <tbody>
    @foreach ($words as $word)
        <tr>
            <td>{{ $word->id }}</td>
            <td>{{ $word->content }}</td>
            <td>{{ $word->category->name }}</td>
            <td>
                {!! Form::open(['route' => ['admin.word.destroy', $word->id], 'method' => 'DELETE']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.word.show', [$word->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.word.edit', [$word->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm(trans('label.confirm_delete'))"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
