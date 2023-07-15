@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.config-create-subtitle'))

@section('laravelticket_header')
    {{ html()->a(route($setting->grab('admin_route').'.configuration.index'), trans('laravelticket::admin.btn-create-new-config'))->class('btn btn-secondary') }}
@stop

@section('laravelticket_content')
    {!! html()->form('POST', route($setting->grab('admin_route').'.priority.store'))->open() !!}
    <!-- Slug Field -->
    <div class="form-group row">
        {!! html()->label('slug', trans('laravelticket::admin.config-edit-slug') . trans('laravelticket::admin.colon'))->class('col-sm-3 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->text('slug', null)->class('form-control') !!}
        </div>
    </div>

    <!-- Default Field -->
    <div class="form-group row">
        {!! html()->label('default', trans('laravelticket::admin.config-edit-default') . trans('laravelticket::admin.colon'))->class('col-sm-3 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->text('default', null)->class('form-control') !!}
        </div>
    </div>

    <!-- Value Field -->
    <div class="form-group row">
        {!! html()->label('value', trans('laravelticket::admin.config-edit-value') . trans('laravelticket::admin.colon'))->class('col-sm-3 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->text('value', null)->class('form-control') !!}
        </div>
    </div>

    <!-- Lang Field -->
    <div class="form-group row">
        {!! html()->label('lang', trans('laravelticket::admin.config-edit-language') . trans('laravelticket::admin.colon'))->class('col-sm-3 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->text('lang', null)->class('form-control') !!}
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-3">
            {!! html()->submit(trans('laravelticket::admin.btn-update'))->class('btn btn-primary') !!}
        </div>
    </div>

    {!! html()->closeModelForm() !!}
@stop

@section('footer')
    <script>
        $(document).ready(function() {
            $("#slug").bind('change', function() {
                var slugger = $('#slug').val();
                slugger = slugger
                    .replace(/\W/g, '.')
                    .toLowerCase();
                $("#slug").val(slugger);
            });

            $("#default").bind('keyup blur keypress change', function() {
                var duplicate = $('#default').val();
                $("#value").val(duplicate);
            });
        });
    </script>
@append
