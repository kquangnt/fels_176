<table class="table table-responsive" id="users-table">
    <thead>
        <th>{{ trans('lesson.id') }}</th>
        <th>{{ trans('lesson.user') }}</th>
        <th>{{ trans('lesson.category') }}</th>
        <th>{{ trans('lesson.action') }}</th>
    </thead>
    <tbody>
    @foreach ($lessons as $lesson)
        <tr>
            <td>{{ $lesson->id }}</td>
            <td>{{ $lesson->user->name }}</td>
            <td>{{ $lesson->category->name }}</td>
            <td>
                {!! Form::open(['route' => ['admin.lesson.destroy', $lesson->id], 'method' => 'DELETE']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.lesson.show', [$lesson->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.lesson.edit', [$lesson->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm("' . trans('label.delete_confirm') . '")']) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
