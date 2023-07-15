@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.priority-edit-title', ['name' => ucwords($priority->name)]))

@section('laravelticket_content')
    {!! html()->modelForm($priority, 'PATCH', route($setting->grab('admin_route').'.priority.update', $priority->id)) !!}

    @include('laravelticket::admin.priority.form', ['update', true])
    {!! html()->closeModelForm() !!}
@stop
