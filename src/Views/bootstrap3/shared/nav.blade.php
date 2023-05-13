<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li role="presentation" class="{!! $tools->fullUrlIs(route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '.index')) ? "active" : "" !!}">
                <a href="{{ route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '.index') }}">{{ trans('laravelticket::lang.nav-active-tickets') }}
                    <span class="badge">
                         <?php
                            if ($u->isAdmin()) {
                                echo Binshops\LaravelTicket\Models\Ticket::active()->count();
                            } elseif ($u->isAgent()) {
                                echo Binshops\LaravelTicket\Models\Ticket::active()->agentUserTickets($u->id)->count();
                            } else {
                                echo Binshops\LaravelTicket\Models\Ticket::userTickets($u->id)->active()->count();
                            }
                        ?>
                    </span>
                </a>
            </li>
            <li role="presentation" class="{!! $tools->fullUrlIs(route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '-complete')) ? "active" : "" !!}">
                <a href="{{ route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '-complete') }}">{{ trans('laravelticket::lang.nav-completed-tickets') }}
                    <span class="badge">
                        <?php
                            if ($u->isAdmin()) {
                                echo Binshops\LaravelTicket\Models\Ticket::complete()->count();
                            } elseif ($u->isAgent()) {
                                echo Binshops\LaravelTicket\Models\Ticket::complete()->agentUserTickets($u->id)->count();
                            } else {
                                echo Binshops\LaravelTicket\Models\Ticket::userTickets($u->id)->complete()->count();
                            }
                        ?>
                    </span>
                </a>
            </li>

            @if($u->isAdmin())
                <li role="presentation" class="{!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\DashboardController@index')) || Request::is($setting->grab('admin_route').'/indicator*') ? "active" : "" !!}">
                    <a href="{{ action('\Binshops\LaravelTicket\Controllers\DashboardController@index') }}">{{ trans('laravelticket::admin.nav-dashboard') }}</a>
                </li>

                <li role="presentation" class="dropdown {!!
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\StatusesController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\PrioritiesController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AgentsController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\CategoriesController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\ConfigurationsController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AdministratorsController@index').'*')
                    ? "active" : "" !!}">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ trans('laravelticket::admin.nav-settings') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" class="{!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\StatusesController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Binshops\LaravelTicket\Controllers\StatusesController@index') }}">{{ trans('laravelticket::admin.nav-statuses') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\PrioritiesController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Binshops\LaravelTicket\Controllers\PrioritiesController@index') }}">{{ trans('laravelticket::admin.nav-priorities') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AgentsController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Binshops\LaravelTicket\Controllers\AgentsController@index') }}">{{ trans('laravelticket::admin.nav-agents') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\CategoriesController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Binshops\LaravelTicket\Controllers\CategoriesController@index') }}">{{ trans('laravelticket::admin.nav-categories') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\ConfigurationsController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Binshops\LaravelTicket\Controllers\ConfigurationsController@index') }}">{{ trans('laravelticket::admin.nav-configuration') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AdministratorsController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Binshops\LaravelTicket\Controllers\AdministratorsController@index')}}">{{ trans('laravelticket::admin.nav-administrator') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</div>
