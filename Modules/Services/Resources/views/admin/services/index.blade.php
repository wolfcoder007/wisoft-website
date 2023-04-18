@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('services::services.title.services') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('services::services.title.services') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.services.service.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('services::services.button.create service') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('services::services.table.title') }}</th>
                                <th>{{ trans('services::services.table.author') }}</th>
                                <th>{{ trans('services::services.table.content') }}</th>
                                <th>{{ trans('services::services.table.status') }}</th>
                                <th>{{ trans('services::services.table.category') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($services)): ?>
                            <?php foreach ($services as $service): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.services.service.edit', [$service->id]) }}">
                                        {{ $service->id }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('admin.services.service.edit', [$service->id]) }}">
                                        {{ $service->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.service.edit', [$service->id]) }}">
                                        {{ $service->author }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.service.edit', [$service->id]) }}">
                                        {{ $service->content }}
                                    </a>
                                </td>
                                
                                
                                <td>
                                    <span class="label {{ $service->present()->statusLabelClass }}">
                                        {{ $service->present()->status }}
                                    </span>
                                </td>
                                
                                        <?php foreach ($categories as $id => $category): ?>
                                     @if($service->category_id == $id) 
                              <td>
                                        <a href="{{ route('admin.services.service.edit', [$service->id]) }}">
                                        {{ $category }}
                                    </a>
                                </td>
                               @endif
                                <?php endforeach; ?>
                                <td>
                                    <a href="{{ route('admin.services.service.edit', [$service->id]) }}">
                                        {{ $service->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.services.service.edit', [$service->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.services.service.destroy', [$service->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('services::services.table.title') }}</th>
                                <th>{{ trans('services::services.table.author') }}</th>
                                <th>{{ trans('services::services.table.content') }}</th>
                                <th>{{ trans('services::services.table.status') }}</th>
                                <th>{{ trans('services::services.table.category') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('services::services.title.create service') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.services.service.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
