@extends($master)
@section('page', trans('laravelticket::admin.status-create-title'))

@section('content')
    @include('laravelticket::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.status.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <legend>{{ trans('laravelticket::admin.status-create-title') }}</legend>
            @include('laravelticket::admin.status.form')
        {!! CollectiveForm::close() !!}
    </div>
@stop
