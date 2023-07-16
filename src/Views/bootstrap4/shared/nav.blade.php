<nav>
    <ul class="nav nav-pills">
        <li role="presentation" class="nav-item">
            <a class="nav-link {!! $tools->fullUrlIs(route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '.index')) ? "active" : "" !!}"
               href="{{ route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '.index') }}">{{ trans('laravelticket::lang.nav-active-tickets') }}
                <span class="badge-pill badge-secondary ">
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
        <li role="presentation" class="nav-item">
            <a class="nav-link {!! $tools->fullUrlIs(route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '-complete')) ? "active" : "" !!}"
               href="{{ route(Binshops\LaravelTicket\Models\Setting::grab('main_route') . '-complete') }}">{{ trans('laravelticket::lang.nav-completed-tickets') }}
                <span class="badge-pill badge-secondary">
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
            <li role="presentation" class="nav-item">
                <a class="nav-link {!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\DashboardController@index')) || Request::is($setting->grab('admin_route').'/indicator*') ? "active" : "" !!}"
                   href="{{ action('\Binshops\LaravelTicket\Controllers\DashboardController@index') }}">{{ trans('laravelticket::admin.nav-dashboard') }}</a>
            </li>

            <li role="presentation" class="nav-item dropdown">

                <a class="nav-link dropdown-toggle {!!
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\StatusesController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\PrioritiesController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AgentsController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\CategoriesController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\ConfigurationsController@index').'*') ||
                    $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AdministratorsController@index').'*')
                    ? "active" : "" !!}"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ trans('laravelticket::admin.nav-settings') }}
                </a>
                <div class="dropdown-menu">
                    <a  class="dropdown-item {!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\StatusesController@index').'*') ? "active" : "" !!}"
                        href="{{ action('\Binshops\LaravelTicket\Controllers\StatusesController@index') }}">{{ trans('laravelticket::admin.nav-statuses') }}</a>

                    <a  class="dropdown-item {!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\PrioritiesController@index').'*') ? "active" : "" !!}"
                        href="{{ action('\Binshops\LaravelTicket\Controllers\PrioritiesController@index') }}">{{ trans('laravelticket::admin.nav-priorities') }}</a>

                    <a  class="dropdown-item {!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AgentsController@index').'*') ? "active" : "" !!}"
                        href="{{ action('\Binshops\LaravelTicket\Controllers\AgentsController@index') }}">{{ trans('laravelticket::admin.nav-agents') }}</a>

                    <a  class="dropdown-item {!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\CategoriesController@index').'*') ? "active" : "" !!}"
                        href="{{ action('\Binshops\LaravelTicket\Controllers\CategoriesController@index') }}">{{ trans('laravelticket::admin.nav-categories') }}</a>

                    <a  class="dropdown-item {!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\ConfigurationsController@index').'*') ? "active" : "" !!}"
                        href="{{ action('\Binshops\LaravelTicket\Controllers\ConfigurationsController@index') }}">{{ trans('laravelticket::admin.nav-configuration') }}</a>

                    <a  class="dropdown-item {!! $tools->fullUrlIs(action('\Binshops\LaravelTicket\Controllers\AdministratorsController@index').'*') ? "active" : "" !!}"
                        href="{{ action('\Binshops\LaravelTicket\Controllers\AdministratorsController@index')}}">{{ trans('laravelticket::admin.nav-administrator') }}</a>

                </div>
            </li>
        @endif

    </ul>
</nav>
