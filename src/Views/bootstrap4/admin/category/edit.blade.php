@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.category-edit-title', ['name' => ucwords($category->name)]))

@section('laravelticket_content')
    {!! CollectiveForm::model($category, [
                                'route' => [$setting->grab('admin_route').'.category.update', $category->id],
                                'method' => 'PATCH',
                                'class' => ''
                                ]) !!}
        @include('laravelticket::admin.category.form', ['update', true])
    {!! CollectiveForm::close() !!}
@stop
