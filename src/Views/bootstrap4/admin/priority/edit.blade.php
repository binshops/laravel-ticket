@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.priority-edit-title', ['name' => ucwords($priority->name)]))

@section('laravelticket_content')
    {!! CollectiveForm::model($priority, [
                                'route' => [$setting->grab('admin_route').'.priority.update', $priority->id],
                                'method' => 'PATCH'
                                ]) !!}
        @include('laravelticket::admin.priority.form', ['update', true])
    {!! CollectiveForm::close() !!}
@stop
