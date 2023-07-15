@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.category-create-title'))

@section('laravelticket_content')
    {!! html()->form('POST', route($setting->grab('admin_route').'.category.store'))->open() !!}

    @include('laravelticket::admin.category.form')
    {!! html()->closeModelForm() !!}
@stop
