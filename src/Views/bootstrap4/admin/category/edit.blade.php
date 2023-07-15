@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.category-edit-title', ['name' => ucwords($category->name)]))

@section('laravelticket_content')
    {!! html()->modelForm($priority, 'PATCH', route($setting->grab('admin_route').'.category.update', $category->id)) !!}

    @include('laravelticket::admin.category.form', ['update', true])
    {!! html()->closeModelForm() !!}
@stop
