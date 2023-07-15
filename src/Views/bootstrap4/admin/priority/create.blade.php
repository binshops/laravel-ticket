@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.priority-create-title'))

@section('laravelticket_content')
    {!! html()->form('POST', route($setting->grab('admin_route').'.priority.store'))->open() !!}

    @include('laravelticket::admin.priority.form')
    {!! html()->closeModelForm() !!}
@stop
