@extends($master)

@section('page')
{{ trans('laravelticket::admin.config-index-title') }}
@stop

@section('content')
@include('laravelticket::shared.header')
        <!-- configuration -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>{{ trans('laravelticket::admin.config-index-title') }}
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                {!! link_to_route(
                    $setting->grab('admin_route').'.configuration.index',
                    trans('laravelticket::admin.btn-back'), null,
                    ['class' => 'btn btn-default'])
                !!}
                {!! link_to_route(
                    $setting->grab('admin_route').'.configuration.create',
                    trans('laravelticket::admin.btn-create-new-config'), null,
                    ['class' => 'btn btn-primary'])
                !!}
            </div>
        </h3>
    </div>
    @if($configurations->isEmpty())
        <div class="well text-center">{{ trans('laravelticket::admin.config-index-no-settings') }}</div>
    @else
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#init-configs">{{ trans('laravelticket::admin.config-index-initial') }}</a></li>
            <li><a data-toggle="tab" href="#ticket-configs">{{ trans('laravelticket::admin.config-index-tickets') }}</a></li>
            <li><a data-toggle="tab" href="#email-configs">{{ trans('laravelticket::admin.config-index-notifications') }}</a></li>
            <li><a data-toggle="tab" href="#perms-configs">{{ trans('laravelticket::admin.config-index-permissions') }}</a></li>
            <li><a data-toggle="tab" href="#editor-configs">{{ trans('laravelticket::admin.config-index-editor') }}</a></li>
            <li><a data-toggle="tab" href="#other-configs">{{ trans('laravelticket::admin.config-index-other') }}</a></li>
        </ul>
    <br />
        <div class="tab-content">
            <div id="init-configs" class="tab-pane fade in active">
                @include('laravelticket::admin.configuration.tables.init_table')
            </div>
            <div id="ticket-configs" class="tab-pane fade">
                @include('laravelticket::admin.configuration.tables.ticket_table')
            </div>
            <div id="email-configs" class="tab-pane fade">
                @include('laravelticket::admin.configuration.tables.email_table')
            </div>
            <div id="perms-configs" class="tab-pane fade">
                @include('laravelticket::admin.configuration.tables.perms_table')
            </div>
            <div id="editor-configs" class="tab-pane fade">
                @include('laravelticket::admin.configuration.tables.editor_table')
            </div>
            <div id="other-configs" class="tab-pane fade">
                @include('laravelticket::admin.configuration.tables.other_table')
            </div>
        </div>
    @endif
    {{--@include('laravelticket::admin.configuration.common.paginate', ['records' => $configurations])--}}
</div>
<!-- // Configuration -->

@endsection
