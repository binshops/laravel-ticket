@extends('laravelticket::layouts.master')

@section('page', trans('laravelticket::admin.status-index-title'))

@section('laravelticket_header')
    <a href="{{ route($setting->grab('admin_route').'.status.create') }}" class="btn btn-primary">{{trans('laravelticket::admin.btn-create-new-status')}}</a>
@stop

@section('laravelticket_content_parent_class', 'p-0')

@section('laravelticket_content')
    @if ($statuses->isEmpty())
        <h3 class="text-center">{{ trans('laravelticket::admin.status-index-no-statuses') }}
            <a href="{{ route($setting->grab('admin_route').'.status.create') }}">{{trans('laravelticket::admin.status-index-create-new')}}</a>
        </h3>
    @else
        <div id="message"></div>
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>{{ trans('laravelticket::admin.table-id') }}</th>
                    <th>{{ trans('laravelticket::admin.table-name') }}</th>
                    <th>{{ trans('laravelticket::admin.table-action') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td style="vertical-align: middle">
                        {{ $status->id }}
                    </td>
                    <td style="color: {{ $status->color }}; vertical-align: middle">
                        {{ $status->name }}
                    </td>
                    <td>
                        {{ html()->a(route($setting->grab('admin_route').'.status.edit', $status->id), trans('laravelticket::admin.btn-edit'))->class('btn btn-info') }}

                        {{
    html()->a(route($setting->grab('admin_route').'.status.destroy', $status->id), trans('laravelticket::admin.btn-delete'))->attributes([
                                                'class' => 'btn btn-danger deleteit',
                                                'form' => "delete-$status->id",
                                                "node" => $status->name
                                                ])
                                                }}

                        {{

    html()->form('DELETE', route($setting->grab('admin_route').'.status.destroy', $status->id))->id("delete-$status->id")->open()
    }}

                        {!! html()->closeModelForm() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@stop

@section('footer')
    <script>
        $( ".deleteit" ).click(function( event ) {
            event.preventDefault();
            if (confirm("{!! trans('laravelticket::admin.status-index-js-delete') !!}" + $(this).attr("node") + " ?"))
            {
                $form = $(this).attr("form");
                $("#" + $form).submit();
            }

        });
    </script>
@append
