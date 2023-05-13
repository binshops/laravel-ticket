<div class="panel panel-default">

    <div class="panel-heading">
        <h2>{{ trans('laravelticket::lang.index-my-tickets') }}
            {!! link_to_route($setting->grab('main_route').'.create', trans('laravelticket::lang.btn-create-new-ticket'), null, ['class' => 'btn btn-primary pull-right']) !!}
        </h2>
    </div>

    <div class="panel-body">
        <div id="message"></div>

        @include('laravelticket::tickets.partials.datatable')
    </div>

</div>
