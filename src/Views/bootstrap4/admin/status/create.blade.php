@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.status-create-title'))

@section('laravelticket_content')
    {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.status.store', 'method' => 'POST', 'class' => '']) !!}
        @include('laravelticket::admin.status.form')
    {!! CollectiveForm::close() !!}
@stop
