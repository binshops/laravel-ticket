@extends($master)
@section('page', trans('laravelticket::admin.status-edit-title', ['name' => ucwords($status->name)]))

@section('content')
    @include('laravelticket::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::model($status, [
                                    'route' => [$setting->grab('admin_route').'.status.update', $status->id],
                                    'method' => 'PATCH',
                                    'class' => 'form-horizontal'
                                    ]) !!}
        <legend>{{ trans('laravelticket::admin.status-edit-title', ['name' => ucwords($status->name)]) }}</legend>
        @include('laravelticket::admin.status.form', ['update', true])
        {!! CollectiveForm::close() !!}
    </div>
@stop
