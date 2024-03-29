            <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <th class="text-center">{{ trans('laravelticket::admin.table-hash') }}</th>
          <th>{{ trans('laravelticket::admin.table-slug') }}</th>
          <th>{{ trans('laravelticket::admin.table-default') }}</th>
          <th>{{ trans('laravelticket::admin.table-value') }}</th>
          <th class="text-center">{{ trans('laravelticket::admin.table-lang') }}</th>
          <th class="text-center">{{ trans('laravelticket::admin.table-edit') }}</th>
        </thead>
        <tbody>
@foreach($configurations_by_sections['init'] as $configuration)
          <tr>
            <td class="text-center">{!! $configuration->id !!}</td>
            <td>{!! $configuration->slug !!}</td>
            <td>{!! $configuration->default !!}</td>
            <td><a href="{!! route($setting->grab('admin_route').'.configuration.edit', [$configuration->id]) !!}" title="{{ trans('laravelticket::admin.table-edit').' '.$configuration->slug }}" data-toggle="tooltip">{!! $configuration->value !!}</a></td>
            <td class="text-center">{!! $configuration->lang !!}</td>
            <td class="text-center">
              {!!
                        html()->a(route($setting->grab('admin_route').'.configuration.edit', $configuration->id), trans('laravelticket::admin.btn-edit'))->attributes(['class' => 'btn btn-info', 'title' => trans('laravelticket::admin.table-edit').' '.$configuration->slug,  'data-toggle' => 'tooltip'])
                    !!}
            </td>
          </tr>
@endforeach
        </tbody>
      </table>
    </div>
