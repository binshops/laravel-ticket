@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.status-edit-title', ['name' => ucwords($status->name)]))

@section('laravelticket_content')
    {!! html()->modelForm($status, 'PATCH', route($setting->grab('admin_route').'.status.update', $status->id)) !!}

    @include('laravelticket::admin.status.form', ['update', true])
    {!! html()->closeModelForm() !!}
@stop
