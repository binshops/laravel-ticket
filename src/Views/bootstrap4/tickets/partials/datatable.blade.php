<table class="laravelticket-table table table-striped  dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <td>{{ trans('laravelticket::lang.table-id') }}</td>
            <td>{{ trans('laravelticket::lang.table-subject') }}</td>
            <td>{{ trans('laravelticket::lang.table-status') }}</td>
            <td>{{ trans('laravelticket::lang.table-last-updated') }}</td>
            <td>{{ trans('laravelticket::lang.table-agent') }}</td>
          @if( $u->isAgent() || $u->isAdmin() )
            <td>{{ trans('laravelticket::lang.table-priority') }}</td>
            <td>{{ trans('laravelticket::lang.table-owner') }}</td>
            <td>{{ trans('laravelticket::lang.table-category') }}</td>
          @endif
        </tr>
    </thead>
</table>
