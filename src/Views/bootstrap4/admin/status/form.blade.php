<div class="form-group">
    {!! html()->label('name', trans('laravelticket::admin.status-create-name') . trans('laravelticket::admin.colon')) !!}
    {!! html()->text('name', isset($status->name) ? $status->name : null)->class('form-control') !!}
</div>
<div class="form-group">
    {!! html()->label('color', trans('laravelticket::admin.status-create-color') . trans('laravelticket::admin.colon')) !!}

    {!! html()->input('color', 'color', isset($status->color) ? $status->color : "#000000")->class('form-control') !!}
</div>

{!! html()->a(route($setting->grab('admin_route').'.status.index'), trans('laravelticket::admin.btn-back'))->class('btn btn-link') !!}
@if(isset($status))
    {!! html()->submit(trans('laravelticket::admin.btn-update'))->class('btn btn-primary') !!}
@else
    {!! html()->submit(trans('laravelticket::admin.btn-submit'))->class('btn btn-primary') !!}
@endif
