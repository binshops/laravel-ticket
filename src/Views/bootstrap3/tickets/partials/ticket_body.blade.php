<div class="panel panel-default">
    <div class="panel-body">
        <div class="content">
            <h2 class="header">
                {{ $ticket->subject }}
                <span class="pull-right">
                    @if(! $ticket->completed_at && $close_perm == 'yes')
                            {!! link_to_route($setting->grab('main_route').'.complete', trans('laravelticket::lang.btn-mark-complete'), $ticket->id,
                                                ['class' => 'btn btn-success']) !!}
                    @elseif($ticket->completed_at && $reopen_perm == 'yes')
                            {!! link_to_route($setting->grab('main_route').'.reopen', trans('laravelticket::lang.reopen-ticket'), $ticket->id,
                                                ['class' => 'btn btn-success']) !!}
                    @endif
                    @if($u->isAgent() || $u->isAdmin())
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticket-edit-modal">
                            {{ trans('laravelticket::lang.btn-edit')  }}
                        </button>
                    @endif
                    @if($u->isAdmin())
                        @if($setting->grab('delete_modal_type') == 'builtin')
                            {!! link_to_route(
                                            $setting->grab('main_route').'.destroy', trans('laravelticket::lang.btn-delete'), $ticket->id,
                                            [
                                            'class' => 'btn btn-danger deleteit',
                                            'form' => "delete-ticket-$ticket->id",
                                            "node" => $ticket->subject
                                            ])
                            !!}
                        @elseif($setting->grab('delete_modal_type') == 'modal')
{{-- // OR; Modal Window: 1/2 --}}
                            {!! CollectiveForm::open(array(
                                    'route' => array($setting->grab('main_route').'.destroy', $ticket->id),
                                    'method' => 'delete',
                                    'style' => 'display:inline'
                               ))
                            !!}
                            <button type="button"
                                    class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="{!! trans('laravelticket::lang.show-ticket-modal-delete-title', ['id' => $ticket->id]) !!}"
                                    data-message="{!! trans('laravelticket::lang.show-ticket-modal-delete-message', ['subject' => $ticket->subject]) !!}"
                             >
                              {{ trans('laravelticket::lang.btn-delete') }}
                            </button>
                        @endif
                            {!! CollectiveForm::close() !!}
{{-- // END Modal Window: 1/2 --}}
                    @endif
                </span>
            </h2>
            <div class="panel well well-sm">
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p> <strong>{{ trans('laravelticket::lang.owner') }}</strong>{{ trans('laravelticket::lang.colon') }}{{ $ticket->user_id == $u->id ? $u->name : $ticket->user->name }}</p>
                            <p>
                                <strong>{{ trans('laravelticket::lang.status') }}</strong>{{ trans('laravelticket::lang.colon') }}
                                @if( $ticket->isComplete() && ! $setting->grab('default_close_status_id') )
                                    <span style="color: blue">Complete</span>
                                @else
                                    <span style="color: {{ $ticket->status->color }}">{{ $ticket->status->name }}</span>
                                @endif

                            </p>
                            <p>
                                <strong>{{ trans('laravelticket::lang.priority') }}</strong>{{ trans('laravelticket::lang.colon') }}
                                <span style="color: {{ $ticket->priority->color }}">
                                    {{ $ticket->priority->name }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p> <strong>{{ trans('laravelticket::lang.responsible') }}</strong>{{ trans('laravelticket::lang.colon') }}{{ $ticket->agent_id == $u->id ? $u->name : $ticket->agent->name }}</p>
                            <p>
                                <strong>{{ trans('laravelticket::lang.category') }}</strong>{{ trans('laravelticket::lang.colon') }}
                                <span style="color: {{ $ticket->category->color }}">
                                    {{ $ticket->category->name }}
                                </span>
                            </p>
                            <p> <strong>{{ trans('laravelticket::lang.created') }}</strong>{{ trans('laravelticket::lang.colon') }}{{ $ticket->created_at->diffForHumans() }}</p>
                            <p> <strong>{{ trans('laravelticket::lang.last-update') }}</strong>{{ trans('laravelticket::lang.colon') }}{{ $ticket->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                {!! $ticket->html !!}
            </div>
        </div>
        {!! CollectiveForm::open([
                        'method' => 'DELETE',
                        'route' => [
                                    $setting->grab('main_route').'.destroy',
                                    $ticket->id
                                    ],
                        'id' => "delete-ticket-$ticket->id"
                        ])
        !!}
        {!! CollectiveForm::close() !!}
    </div>
</div>

    @if($u->isAgent() || $u->isAdmin())
        @include('laravelticket::tickets.edit')
    @endif

{{-- // OR; Modal Window: 2/2 --}}
    @if($u->isAdmin())
        @include('laravelticket::tickets.partials.modal-delete-confirm')
    @endif
{{-- // END Modal Window: 2/2 --}}
