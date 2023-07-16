@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::lang.show-ticket-title') . trans('laravelticket::lang.colon') . $ticket->subject)
@section('page_title', $ticket->subject)

@section('laravelticket_header')
    <div>
        @if(! $ticket->completed_at && $close_perm == 'yes')
            {!! html()->a(route($setting->grab('main_route').'.complete', $ticket->id), trans('laravelticket::lang.btn-mark-complete'))->class('btn btn-success') !!}
        @elseif($ticket->completed_at && $reopen_perm == 'yes')
            {!! html()->a(route($setting->grab('main_route').'.reopen', $ticket->id), trans('laravelticket::lang.reopen-ticket'))->class('btn btn-success') !!}
        @endif
        @if($u->isAgent() || $u->isAdmin())
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ticket-edit-modal">
                {{ trans('laravelticket::lang.btn-edit')  }}
            </button>
        @endif
        @if($u->isAdmin())
            @if($setting->grab('delete_modal_type') == 'builtin')
                {!! html()->a(route($setting->grab('main_route').'.destroy', $ticket->id), trans('laravelticket::lang.btn-delete'))->attributes([
                                'class' => 'btn btn-danger deleteit',
                                'form' => "delete-ticket-$ticket->id",
                                "node" => $ticket->subject
                                ]) !!}
            @elseif($setting->grab('delete_modal_type') == 'modal')
                {{-- // OR; Modal Window: 1/2 --}}
                {!! html()->form('delete', route($setting->grab('main_route').'.destroy', $ticket->id))->style('display:inline')->open() !!}
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
            {!! html()->closeModelForm() !!}
            {{-- // END Modal Window: 1/2 --}}
        @endif
    </div>
@stop

@section('laravelticket_content')
    @include('laravelticket::tickets.partials.ticket_body')
@endsection

@section('laravelticket_extra_content')
    <h2 class="mt-5">{{ trans('laravelticket::lang.comments') }}</h2>
    @include('laravelticket::tickets.partials.comments')
    {{-- pagination --}}
    {!! $comments->render("pagination::bootstrap-4") !!}
    @include('laravelticket::tickets.partials.comment_form')
@stop

@section('footer')
    <script>
        $(document).ready(function() {
            $( ".deleteit" ).click(function( event ) {
                event.preventDefault();
                if (confirm("{!! trans('laravelticket::lang.show-ticket-js-delete') !!}" + $(this).attr("node") + " ?"))
                {
                    var form = $(this).attr("form");
                    $("#" + form).submit();
                }

            });
            $('#category_id').change(function(){
                var loadpage = "{!! route($setting->grab('main_route').'agentselectlist') !!}/" + $(this).val() + "/{{ $ticket->id }}";
                $('#agent_id').load(loadpage);
            });
            $('#confirmDelete').on('show.bs.modal', function (e) {
                $message = $(e.relatedTarget).attr('data-message');
                $(this).find('.modal-body p').text($message);
                $title = $(e.relatedTarget).attr('data-title');
                $(this).find('.modal-title').text($title);

                // Pass form reference to modal for submission on yes/ok
                var form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);
            });

            <!-- Form confirm (yes/ok) handler, submits form -->
            $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
                $(this).data('form').submit();
            });
        });
    </script>
    @include('laravelticket::tickets.partials.summernote')
@append
