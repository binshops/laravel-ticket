{!! html()->form('POST', route($setting->grab('main_route').'-comment.store'))->open() !!}

{!! html()->hidden('ticket_id', $ticket->id) !!}

{!! html()->textarea('content', null)->attributes(['class' => 'form-control summernote-editor', 'rows' => "3"]) !!}

{!! html()->submit(trans('laravelticket::lang.reply'))->class('btn btn-outline-primary pull-right mt-3 mb-3') !!}

{!! html()->closeModelForm() !!}
