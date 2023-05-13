<div class="form-group">
    {!! CollectiveForm::label('name', trans('laravelticket::admin.status-create-name') . trans('laravelticket::admin.colon'), ['class' => '']) !!}
    {!! CollectiveForm::text('name', isset($status->name) ? $status->name : null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! CollectiveForm::label('color', trans('laravelticket::admin.status-create-color') . trans('laravelticket::admin.colon'), ['class' => '']) !!}
    {!! CollectiveForm::custom('color', 'color', isset($status->color) ? $status->color : "#000000", ['class' => 'form-control']) !!}
</div>

{!! link_to_route($setting->grab('admin_route').'.status.index', trans('laravelticket::admin.btn-back'), null, ['class' => 'btn btn-link']) !!}
@if(isset($status))
    {!! CollectiveForm::submit(trans('laravelticket::admin.btn-update'), ['class' => 'btn btn-primary']) !!}
@else
    {!! CollectiveForm::submit(trans('laravelticket::admin.btn-submit'), ['class' => 'btn btn-primary']) !!}
@endif
