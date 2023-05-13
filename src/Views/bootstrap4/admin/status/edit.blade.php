@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.status-edit-title', ['name' => ucwords($status->name)]))

@section('laravelticket_content')
    {!! CollectiveForm::model($status, [
                                    'route' => [$setting->grab('admin_route').'.status.update', $status->id],
                                    'method' => 'PATCH'
                                    ]) !!}
        @include('laravelticket::admin.status.form', ['update', true])
    {!! CollectiveForm::close() !!}
@stop
