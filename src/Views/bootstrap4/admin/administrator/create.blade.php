@extends('laravelticket::layouts.master')
@section('page', trans('laravelticket::admin.administrator-create-title'))

@section('laravelticket_content')
    @if ($users->isEmpty())
        <h3 class="text-center">{{ trans('laravelticket::admin.administrator-create-no-users') }}</h3>
    @else
        {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.administrator.store', 'method' => 'POST', 'class' => '']) !!}
        <p>{{ trans('laravelticket::admin.administrator-create-select-user') }}</p>
        <table class="table table-hover">
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="form-check form-check-inline">
                            <input name="administrators[]" type="checkbox" class="form-check-input" value="{{ $user->id }}" {!! $user->laravelticket_admin ? "checked" : "" !!}>
                            <label class="form-check-label">{{ $user->name }}</label>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! link_to_route($setting->grab('admin_route').'.administrator.index', trans('laravelticket::admin.btn-back'), null, ['class' => 'btn btn-link']) !!}
        {!! CollectiveForm::submit(trans('laravelticket::admin.btn-submit'), ['class' => 'btn btn-primary']) !!}
        {!! CollectiveForm::close() !!}
    @endif
    {!! $users->render("pagination::bootstrap-4") !!}
@stop
