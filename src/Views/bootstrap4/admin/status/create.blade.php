@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.status-create-title'))

@section('laravelticket_content')
    {!! html()->form('POST', route($setting->grab('admin_route').'.status.store'))->open() !!}

    @include('laravelticket::admin.status.form')

    {!! html()->closeModelForm() !!}
@stop
