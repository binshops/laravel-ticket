@extends('laravelticket::layouts.master')

@section('page', trans('laravelticket::admin.config-edit-subtitle'))

@section('laravelticket_header')
    {{ html()->a(route($setting->grab('admin_route').'.configuration.index'), trans('laravelticket::admin.btn-back'))->class('btn btn-secondary') }}
@stop

@section('laravelticket_content')
    {!!
        html()->modelForm($configuration, 'patch', route($setting->grab('admin_route').'.configuration.update', $configuration->id))
    !!}
    <div class="card bg-light mb-3">
        <div class="card-body">
            <b>{{ trans('laravelticket::admin.config-edit-tools') }}</b>
            <br>
            <a href="https://www.functions-online.com/unserialize.html" target="_blank">
                {{ trans('laravelticket::admin.config-edit-unserialize') }}
            </a>
            <br>
            <a href="https://www.functions-online.com/serialize.html" target="_blank">
                {{ trans('laravelticket::admin.config-edit-serialize') }}
            </a>
        </div>
    </div>

    @if(trans("laravelticket::settings." . $configuration->slug) != ("laravelticket::settings." . $configuration->slug) && trans("laravelticket::settings." . $configuration->slug))
        <div class="card border-info mb-3">
            <div class="card-body">{!! trans("laravelticket::settings." . $configuration->slug) !!}</div>
        </div>
    @endif

    <!-- ID Field -->
    <div class="form-group row">
        {!! html()->label('id', trans('laravelticket::admin.config-edit-id') . trans('laravelticket::admin.colon'))->class('col-sm-2 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->text('id', null)->class('form-control')->disabled() !!}
        </div>
    </div>

    <!-- Slug Field -->
    <div class="form-group row">
        {!! html()->label('slug', trans('laravelticket::admin.config-edit-slug') . trans('laravelticket::admin.colon'))->class('col-sm-2 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->text('slug', null)->class('form-control')->disabled() !!}
        </div>
    </div>

    <div class="form-group row">
        {!! html()->label('default', trans('laravelticket::admin.config-edit-default') . trans('laravelticket::admin.colon'))->class('col-sm-2 col-form-label') !!}
        <div class="col-sm-9">
            @if(!$default_serialized)
                {!! html()->text('default', null)->class('form-control')->disabled() !!}
            @else
                <pre>{{var_export(unserialize($configuration->default), true)}}</pre>
            @endif
        </div>
    </div>


    <!-- Value Field -->
    <div class="form-group row">
        {!! html()->label('value', trans('laravelticket::admin.config-edit-value') . trans('laravelticket::admin.colon'))->class('col-sm-2 col-form-label') !!}
        <div class="col-sm-9">
            @if(!$should_serialize)
                {!! html()->text('value', null)->class('form-control') !!}
            @else
                {!! html()->textarea('value', var_export(unserialize($configuration->value)))->class('form-control') !!}
            @endif
        </div>
    </div>

    <!-- Serialize Field -->
    <div class="form-group row">
        {!! html()->label('serialize', trans('laravelticket::admin.config-edit-should-serialize') . trans('laravelticket::admin.colon'))->class('col-sm-2 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->checkbox('serialize', 1, $should_serialize)->attributes(['class' => 'form-control', 'onchange' =>  'changeSerialize(this)']) !!}
            <span class="form-text" style="color: red;">@lang('laravelticket::admin.config-edit-eval-warning') <code>eval('$value = serialize(' . $value . ');')</code></span>
        </div>
    </div>

    <!-- Password Field -->
    <div id="serialize-password" class="form-group row">
        {!! html()->label('password', trans('laravelticket::admin.config-edit-reenter-password') . trans('laravelticket::admin.colon'))->class('col-sm-2 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->password('password')->class('form-control') !!}
        </div>
    </div>

    <!-- Lang Field -->
    <div class="form-group row">
        {!! html()->label('lang', trans('laravelticket::admin.config-edit-language') . trans('laravelticket::admin.colon'))->class('col-sm-2 col-form-label') !!}

        <div class="col-sm-9">
            {!! html()->text('lang', null)->class('form-control') !!}
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group row">
        <div class="col-sm-10 col-sm-offset-2">
            {!! html()->submit(trans('laravelticket::admin.btn-submit'))->class('btn btn-primary') !!}
        </div>
    </div>

    {!! html()->closeModelForm() !!}

    <script>
        function changeSerialize(e){
            document.querySelector("#serialize-password").style.display = e.checked ? 'flex' : 'none';
            document.querySelector(".form-text").style.display = e.checked ? 'block' : 'none';
        }
        changeSerialize(document.querySelector("input[name='serialize']"));
    </script>

    @if($should_serialize)
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/{{ Binshops\LaravelTicket\Helpers\Cdn::CodeMirror }}/codemirror.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/{{ Binshops\LaravelTicket\Helpers\Cdn::CodeMirror }}/mode/clike/clike.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/{{ Binshops\LaravelTicket\Helpers\Cdn::CodeMirror }}/mode/php/php.min.js"></script>

        <script>

            loadCSS({!! '"'.asset('https://cdnjs.cloudflare.com/ajax/libs/codemirror/' . Binshops\LaravelTicket\Helpers\Cdn::CodeMirror . '/codemirror.min.css').'"' !!});
            loadCSS({!! '"'.asset('https://cdnjs.cloudflare.com/ajax/libs/codemirror/' . Binshops\LaravelTicket\Helpers\Cdn::CodeMirror . '/theme/monokai.min.css').'"' !!});

            window.addEventListener('load', function(){
                CodeMirror.fromTextArea( document.querySelector("textarea[name='value']"), {
                    lineNumbers: true,
                    mode: 'text/x-php',
                    theme: 'monokai',
                    indentUnit: 2,
                    lineWrapping: true
                });
            });

        </script>
    @endif

@stop
