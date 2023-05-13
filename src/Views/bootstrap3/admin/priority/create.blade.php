@extends($master)
@section('page', trans('laravelticket::admin.priority-create-title'))

@section('content')
    @include('laravelticket::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.priority.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <legend>{{ trans('laravelticket::admin.priority-create-title') }}</legend>
            @include('laravelticket::admin.priority.form')
        {!! CollectiveForm::close() !!}
    </div>
@stop
