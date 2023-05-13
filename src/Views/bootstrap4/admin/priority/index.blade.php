@extends('laravelticket::layouts.master')

@section('page', trans('laravelticket::admin.priority-index-title'))

@section('laravelticket_header')
{!! link_to_route(
    $setting->grab('admin_route').'.priority.create',
    trans('laravelticket::admin.btn-create-new-priority'), null,
    ['class' => 'btn btn-primary'])
!!}
@stop

@section('laravelticket_content_parent_class', 'p-0')

@section('laravelticket_content')
    @if ($priorities->isEmpty())
        <h3 class="text-center">{{ trans('laravelticket::admin.priority-index-no-priorities') }}
            {!! link_to_route($setting->grab('admin_route').'.priority.create', trans('laravelticket::admin.priority-index-create-new')) !!}
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
            @foreach($priorities as $priority)
                <tr>
                    <td style="vertical-align: middle">
                        {{ $priority->id }}
                    </td>
                    <td style="color: {{ $priority->color }}; vertical-align: middle">
                        {{ $priority->name }}
                    </td>
                    <td>
                        {!! link_to_route(
                                                $setting->grab('admin_route').'.priority.edit', trans('laravelticket::admin.btn-edit'), $priority->id,
                                                ['class' => 'btn btn-info'] )
                            !!}

                            {!! link_to_route(
                                                $setting->grab('admin_route').'.priority.destroy', trans('laravelticket::admin.btn-delete'), $priority->id,
                                                [
                                                'class' => 'btn btn-danger deleteit',
                                                'form' => "delete-$priority->id",
                                                "node" => $priority->name
                                                ])
                            !!}
                        {!! CollectiveForm::open([
                                        'method' => 'DELETE',
                                        'route' => [
                                                    $setting->grab('admin_route').'.priority.destroy',
                                                    $priority->id
                                                    ],
                                        'id' => "delete-$priority->id"
                                        ])
                        !!}
                        {!! CollectiveForm::close() !!}
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
            if (confirm("{!! trans('laravelticket::admin.priority-index-js-delete') !!}" + $(this).attr("node") + " ?"))
            {
                $form = $(this).attr("form");
                $("#" + $form).submit();
            }

        });
    </script>
@append
