<div class="form-group">
    {!! CollectiveForm::label('name', trans('laravelticket::admin.category-create-name') . trans('laravelticket::admin.colon'), ['class' => '']) !!}
    {!! CollectiveForm::text('name', isset($category->name) ? $category->name : null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! CollectiveForm::label('color', trans('laravelticket::admin.category-create-color') . trans('laravelticket::admin.colon'), ['class' => '']) !!}
    {!! CollectiveForm::custom('color', 'color', isset($category->color) ? $category->color : "#000000", ['class' => 'form-control']) !!}
</div>

{!! link_to_route($setting->grab('admin_route').'.category.index', trans('laravelticket::admin.btn-back'), null, ['class' => 'btn btn-link']) !!}
@if(isset($category))
    {!! CollectiveForm::submit(trans('laravelticket::admin.btn-update'), ['class' => 'btn btn-primary']) !!}
@else
    {!! CollectiveForm::submit(trans('laravelticket::admin.btn-submit'), ['class' => 'btn btn-primary']) !!}
@endif
