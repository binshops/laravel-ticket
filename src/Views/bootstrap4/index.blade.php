@extends('laravelticket::layouts.master')

@section('page', trans('laravelticket::lang.index-title'))
@section('page_title', trans('laravelticket::lang.index-my-tickets'))


@section('laravelticket_header')
	<a href="{{ route($setting->grab('main_route').'.create') }}" class="btn btn-primary">{{trans('laravelticket::lang.btn-create-new-ticket')}}</a>
@stop

@section('laravelticket_content_parent_class', 'pl-0 pr-0')

@section('laravelticket_content')
    <div id="message"></div>
    @include('laravelticket::tickets.partials.datatable')
@stop

@section('footer')
	<script src="https://cdn.datatables.net/v/bs4/dt-{{ Binshops\LaravelTicket\Helpers\Cdn::DataTables }}/r-{{ Binshops\LaravelTicket\Helpers\Cdn::DataTablesResponsive }}/datatables.min.js"></script>
	<script>
	    $('.table').DataTable({
	        processing: false,
	        serverSide: true,
	        responsive: true,
            pageLength: {{ $setting->grab('paginate_items') }},
        	lengthMenu: {{ json_encode($setting->grab('length_menu')) }},
	        ajax: '{!! route($setting->grab('main_route').'.data', $complete) !!}',
	        language: {
				decimal:        "{{ trans('laravelticket::lang.table-decimal') }}",
				emptyTable:     "{{ trans('laravelticket::lang.table-empty') }}",
				info:           "{{ trans('laravelticket::lang.table-info') }}",
				infoEmpty:      "{{ trans('laravelticket::lang.table-info-empty') }}",
				infoFiltered:   "{{ trans('laravelticket::lang.table-info-filtered') }}",
				infoPostFix:    "{{ trans('laravelticket::lang.table-info-postfix') }}",
				thousands:      "{{ trans('laravelticket::lang.table-thousands') }}",
				lengthMenu:     "{{ trans('laravelticket::lang.table-length-menu') }}",
				loadingRecords: "{{ trans('laravelticket::lang.table-loading-results') }}",
				processing:     "{{ trans('laravelticket::lang.table-processing') }}",
				search:         "{{ trans('laravelticket::lang.table-search') }}",
				zeroRecords:    "{{ trans('laravelticket::lang.table-zero-records') }}",
				paginate: {
					first:      "{{ trans('laravelticket::lang.table-paginate-first') }}",
					last:       "{{ trans('laravelticket::lang.table-paginate-last') }}",
					next:       "{{ trans('laravelticket::lang.table-paginate-next') }}",
					previous:   "{{ trans('laravelticket::lang.table-paginate-prev') }}"
				},
				aria: {
					sortAscending:  "{{ trans('laravelticket::lang.table-aria-sort-asc') }}",
					sortDescending: "{{ trans('laravelticket::lang.table-aria-sort-desc') }}"
				},
			},
	        columns: [
	            { data: 'id', name: 'laravelticket.id' },
	            { data: 'subject', name: 'subject' },
	            { data: 'status', name: 'laravelticket_statuses.name' },
	            { data: 'updated_at', name: 'laravelticket.updated_at' },
            	{ data: 'agent', name: 'users.name' },
	            @if( $u->isAgent() || $u->isAdmin() )
		            { data: 'priority', name: 'laravelticket_priorities.name' },
	            	{ data: 'owner', name: 'users.name' },
		            { data: 'category', name: 'laravelticket_categories.name' }
	            @endif
	        ]
	    });
	</script>
@append
