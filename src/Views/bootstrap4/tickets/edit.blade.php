<div class="modal fade" id="ticket-edit-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-modal-Label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!!
                html()->modelForm($ticket, 'PATCH', route($setting->grab('main_route').'.update', $ticket->id))->class('form-horizontal')
            !!}
            <div class="modal-header">
                <h5 class="modal-title" id="ticket-edit-modal-Label">{{ $ticket->subject }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">{{ trans('laravelticket::lang.flash-x') }}</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! html()->text('subject', $ticket->subject)->class('form-control')->required() !!}
                </div>
                <div class="form-group">
                    <textarea class="form-control summernote-editor" rows="5" required name="content" cols="50">{!! htmlspecialchars($ticket->html) !!}</textarea>
                </div>

                <div class="form-group">
                    {!! html()->label('priority_id', trans('laravelticket::lang.priority') . trans('laravelticket::lang.colon')) !!}
                    {!! html()->select('priority_id', $priority_lists, $ticket->priority_id)->class('form-control') !!}
                </div>

                <div class="form-group">
                    {!! html()->label('agent_id',trans('laravelticket::lang.agent') . trans('laravelticket::lang.colon') ) !!}

                    {!! html()->select('agent_id',
                        $agent_lists,
                        $ticket->agent_id)->class('form-control') !!}
                </div>

                <div class="form-group">
                    {!! html()->label('category_id', trans('laravelticket::lang.category') . trans('laravelticket::lang.colon')) !!}

                    {!! html()->select('category_id', $category_lists, $ticket->category_id)->class('form-control') !!}

                </div>

                <div class="form-group">
                    {!! html()->label('status_id', trans('laravelticket::lang.status') . trans('laravelticket::lang.colon')) !!}

                    {!! html()->select('status_id', $status_lists, $ticket->status_id)->class('form-control') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('laravelticket::lang.btn-close') }}</button>
                {!! html()->submit(trans('laravelticket::admin.btn-submit'))->class('btn btn-primary') !!}
            </div>
            {!! html()->closeModelForm() !!}
        </div>
    </div>
</div>
