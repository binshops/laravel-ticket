@extends('laravelticket::layouts.master')

@section('page', trans('laravelticket::admin.category-index-title'))

@section('laravelticket_header')
    {{ html()->a(route($setting->grab('admin_route').'.category.create'), trans('laravelticket::admin.btn-create-new-category'))->class('btn btn-primary') }}
@stop

@section('laravelticket_content_parent_class', 'p-0')

@section('laravelticket_content')
    @if ($categories->isEmpty())
        <h3 class="text-center">{{ trans('laravelticket::admin.category-index-no-categories') }}
            {{ html()->a(route($setting->grab('admin_route').'.category.create'), trans('laravelticket::admin.category-index-create-new')) }}
        </h3>
    @else
        <div id="message"></div>
        <table class="table table-hover mb-0">
            <thead>
            <tr>
                <th>{{ trans('laravelticket::admin.table-id') }}</th>
                <th>{{ trans('laravelticket::admin.table-name') }}</th>
                <th>{{ trans('laravelticket::admin.table-action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td style="vertical-align: middle">
                        {{ $category->id }}
                    </td>
                    <td style="color: {{ $category->color }}; vertical-align: middle">
                        {{ $category->name }}
                    </td>
                    <td>
                        {{ html()->a(route($setting->grab('admin_route').'.category.edit', $category->id), trans('laravelticket::admin.btn-edit'))->class('btn btn-info') }}

                        {{
    html()->a(route($setting->grab('admin_route').'.category.destroy', $category->id), trans('laravelticket::admin.btn-delete'))->attributes([
                                                'class' => 'btn btn-danger deleteit',
                                                'form' => "delete-$category->id",
                                                "node" => $category->name
                                                ])
                        }}

                        {{
    html()->form('DELETE', route($setting->grab('admin_route').'.category.destroy', $category->id))->id("delete-$category->id")->open()
                        }}

                        {!! html()->closeModelForm() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@stop
@section('footer')
    <script>
        $(function() {
            $( ".deleteit" ).click(function( event ) {
                event.preventDefault();
                if (confirm("{!! trans('laravelticket::admin.category-index-js-delete') !!}" + $(this).attr("node") + " ?"))
                {
                    var form = $(this).attr("form");
                    $("#" + form).submit();
                }

            });
        });
    </script>
@append
