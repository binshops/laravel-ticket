@extends('laravelticket::layouts.master')

@section('page', trans('laravelticket::admin.agent-index-title'))

@section('laravelticket_header')
    {{ html()->a(route($setting->grab('admin_route').'.agent.create'), trans('laravelticket::admin.btn-create-new-agent'))->class('btn btn-primary') }}

@stop

@section('laravelticket_content_parent_class', 'p-0')

@section('laravelticket_content')
    @if ($agents->isEmpty())
        <h3 class="text-center">{{ trans('laravelticket::admin.agent-index-no-agents') }}
            {{ html()->a(route($setting->grab('admin_route').'.agent.create'), trans('laravelticket::admin.agent-index-create-new')) }}
        </h3>
    @else
        <div id="message"></div>
        <table class="table table-hover mb-0">
            <thead>
            <tr>
                <th>{{ trans('laravelticket::admin.table-id') }}</th>
                <th>{{ trans('laravelticket::admin.table-name') }}</th>
                <th>{{ trans('laravelticket::admin.table-categories') }}</th>
                <th>{{ trans('laravelticket::admin.table-join-category') }}</th>
                <th>{{ trans('laravelticket::admin.table-remove-agent') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($agents as $agent)
                <tr>
                    <td>
                        {{ $agent->id }}
                    </td>
                    <td>
                        {{ $agent->name }}
                    </td>
                    <td>
                        @foreach($agent->categories as $category)
                            <span style="color: {{ $category->color }}">
                                {{  $category->name }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        {!!
     html()->form('PATCH', route($setting->grab('admin_route').'.agent.update', $agent->id))->open()
     !!}

                        @foreach(\Binshops\LaravelTicket\Models\Category::all() as $agent_cat)
                            <input name="agent_cats[]"
                                   type="checkbox"
                                   class="form-check-input"
                                   value="{{ $agent_cat->id }}"
                                    {!! ($agent_cat->agents()->where("id", $agent->id)->count() > 0) ? "checked" : ""  !!}
                            > {{ $agent_cat->name }}
                        @endforeach
                        {!! html()->submit(trans('laravelticket::admin.btn-join'))->class('btn btn-info btn-sm') !!}
                        {!! html()->closeModelForm() !!}
                    </td>
                    <td>
                        {!!
     html()->form('DELETE', route($setting->grab('admin_route').'.agent.destroy', $agent->id))->id("delete-$agent->id")->open()
     !!}

                        {!! html()->submit(trans('laravelticket::admin.btn-remove'))->class('btn btn-danger') !!}
                        {!! html()->closeModelForm() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
@stop
