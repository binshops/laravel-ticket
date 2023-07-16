<div class="card mb-3">
    <div class="card-body row">
        <div class="col-md-6">
            <p><strong>{{ trans('laravelticket::lang.owner') }}</strong>{{ trans('laravelticket::lang.colon') }}{{ $ticket->user_id == $u->id ? $u->name : $ticket->user->name }}</p>
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

{!! $ticket->html !!}

{!! html()->form('DELETE', route($setting->grab('main_route').'.destroy', $ticket->id))->id("delete-ticket-$ticket->id")->open() !!}

{!! html()->closeModelForm() !!}

@if($u->isAgent() || $u->isAdmin())
    @include('laravelticket::tickets.edit')
@endif

{{-- // OR; Modal Window: 2/2 --}}
@if($u->isAdmin())
    @include('laravelticket::tickets.partials.modal-delete-confirm')
@endif
{{-- // END Modal Window: 2/2 --}}
