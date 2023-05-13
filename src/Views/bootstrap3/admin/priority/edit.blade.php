@extends($master)
@section('page', trans('laravelticket::admin.priority-edit-title', ['name' => ucwords($priority->name)]))

@section('content')
    @include('laravelticket::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::model($priority, [
                                    'route' => [$setting->grab('admin_route').'.priority.update', $priority->id],
                                    'method' => 'PATCH',
                                    'class' => 'form-horizontal'
                                    ]) !!}
        <legend>{{ trans('laravelticket::admin.priority-edit-title', ['name' => ucwords($priority->name)]) }}</legend>
        @include('laravelticket::admin.priority.form', ['update', true])
        {!! CollectiveForm::close() !!}
    </div>
@stop
