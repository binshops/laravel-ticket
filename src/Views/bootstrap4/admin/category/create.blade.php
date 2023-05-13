@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.category-create-title'))

@section('laravelticket_content')
    {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.category.store', 'method' => 'POST', 'class' => '']) !!}
        @include('laravelticket::admin.category.form')
    {!! CollectiveForm::close() !!}
@stop
