@extends($master)
@section('page', trans('laravelticket::admin.category-edit-title', ['name' => ucwords($category->name)]))

@section('content')
    @include('laravelticket::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::model($category, [
                                    'route' => [$setting->grab('admin_route').'.category.update', $category->id],
                                    'method' => 'PATCH',
                                    'class' => 'form-horizontal'
                                    ]) !!}
        <legend>{{ trans('laravelticket::admin.category-edit-title', ['name' => ucwords($category->name)]) }}</legend>
        @include('laravelticket::admin.category.form', ['update', true])
        {!! CollectiveForm::close() !!}
    </div>
@stop
