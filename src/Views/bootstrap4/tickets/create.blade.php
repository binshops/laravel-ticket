@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::lang.create-ticket-title'))
@section('page_title', trans('laravelticket::lang.create-new-ticket'))

@section('laravelticket_content')
    {!! html()->form('POST', route($setting->grab('main_route').'.store'))->open()!!}
    <div class="form-group row">
        {!! html()->label('subject', trans('laravelticket::lang.subject') . trans('laravelticket::lang.colon'))->class('col-lg-2 col-form-label') !!}
        <div class="col-lg-10">
            {!! html()->text('subject', null)->class('form-control')->required(true) !!}
            <small class="form-text text-muted">{!! trans('laravelticket::lang.create-ticket-brief-issue') !!}</small>
        </div>
    </div>
    <div class="form-group row">
        {!! html()->label('content', trans('laravelticket::lang.description') . trans('laravelticket::lang.colon'))->class('col-lg-2 col-form-label') !!}
        <div class="col-lg-10">
            {!! html()->textarea('content', null)->class('form-control summernote-editor')->rows(5)->required() !!}
            <small class="form-text text-muted">{!! trans('laravelticket::lang.create-ticket-describe-issue') !!}</small>
        </div>
    </div>
    <div class="form-row mt-5">
        <div class="form-group col-lg-4 row">
            {!! html()->label('priority', trans('laravelticket::lang.priority') . trans('laravelticket::lang.colon'))->class('col-lg-6 col-form-label') !!}
            <div class="col-lg-6">
                {!! html()->select('priority_id', $priorities, null)->class('form-control')->required() !!}
            </div>
        </div>
        <div class="form-group col-lg-4 row">
            {!! html()->label('category', trans('laravelticket::lang.category') . trans('laravelticket::lang.colon'))->class('col-lg-6 col-form-label')!!}
            <div class="col-lg-6">
                {!! html()->select('category_id', $categories, null)->class('form-control')->required() !!}
            </div>
        </div>
        {!! html()->hidden('agent_id', 'auto') !!}
    </div>
    <br>
    <div class="form-group row">
        <div class="col-lg-10 offset-lg-2">
            <a href="{{ route($setting->grab('main_route').'.index') }}" class="btn btn-link">{{trans('laravelticket::lang.btn-back')}}</a>

            {!! html()->submit(trans('laravelticket::lang.btn-submit'))->class('btn btn-primary') !!}
        </div>
    </div>
    {!! html()->closeModelForm() !!}
@endsection

@section('footer')
    @include('laravelticket::tickets.partials.summernote')
@append
