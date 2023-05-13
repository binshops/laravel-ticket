@extends($master)

@section('page')
    {{ trans('laravelticket::admin.administrator-index-title') }}
@stop

@section('content')
    @include('laravelticket::shared.header')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ trans('laravelticket::admin.administrator-index-title') }}
                {!! link_to_route(
                                    $setting->grab('admin_route').'.administrator.create',
                                    trans('laravelticket::admin.btn-create-new-administrator'), null,
                                    ['class' => 'btn btn-primary pull-right'])
                !!}
            </h2>
        </div>

        @if ($administrators->isEmpty())
            <h3 class="text-center">{{ trans('laravelticket::admin.administrator-index-no-administrators') }}
                {!! link_to_route($setting->grab('admin_route').'.administrator.create', trans('laravelticket::admin.administrator-index-create-new')) !!}
            </h3>
        @else
            <div id="message"></div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <td>{{ trans('laravelticket::admin.table-id') }}</td>
                    <td>{{ trans('laravelticket::admin.table-name') }}</td>
                    <td>{{ trans('laravelticket::admin.table-remove-administrator') }}</td>
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
                            {!! CollectiveForm::open([
                            'method' => 'DELETE',
                            'route' => [
                                        $setting->grab('admin_route').'.administrator.destroy',
                                        $administrator->id
                                        ],
                            'id' => "delete-$administrator->id"
                            ]) !!}
                            {!! CollectiveForm::submit(trans('laravelticket::admin.btn-remove'), ['class' => 'btn btn-danger']) !!}
                            {!! CollectiveForm::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @endif
    </div>
@stop
