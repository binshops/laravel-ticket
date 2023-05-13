@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.priority-create-title'))

@section('laravelticket_content')
    {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.priority.store', 'method' => 'POST', 'class' => '']) !!}
        @include('laravelticket::admin.priority.form')
    {!! CollectiveForm::close() !!}
@stop
