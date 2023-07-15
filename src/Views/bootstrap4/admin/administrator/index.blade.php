@extends('laravelticket::layouts.master')

@section('page', trans('laravelticket::admin.administrator-index-title'))

@section('laravelticket_header')
    {{ html()->a(route($setting->grab('admin_route').'.administrator.create'), trans('laravelticket::admin.btn-create-new-administrator'))->class('btn btn-primary') }}
@stop

@section('laravelticket_content_parent_class', 'p-0')

@section('laravelticket_content')
    @if ($administrators->isEmpty())
        <h3 class="text-center">{{ trans('laravelticket::admin.administrator-index-no-administrators') }}
            {{ html()->a(route($setting->grab('admin_route').'.administrator.create'), trans('laravelticket::admin.administrator-index-create-new')) }}
        </h3>
    @else
        <div id="message"></div>
        <table class="table table-hover mb-0">
            <thead>
            <tr>
                <th>{{ trans('laravelticket::admin.table-id') }}</th>
                <th>{{ trans('laravelticket::admin.table-name') }}</th>
                <th>{{ trans('laravelticket::admin.table-remove-administrator') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($administrators as $administrator)
                <tr>
                    <td>
                        {{ $administrator->id }}
                    </td>
                    <td>
                        {{ $administrator->name }}
                    </td>
                    <td>
                        {!! html()->form('DELETE', route($setting->grab('admin_route').'.administrator.destroy', $administrator->id))->id("delete-$administrator->id")->open() !!}

                        {!! html()->submit(trans('laravelticket::admin.btn-remove'))->class('btn btn-danger') !!}
                        {!! html()->closeModelForm() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@stop
