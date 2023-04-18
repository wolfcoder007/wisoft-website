@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('industry::industries.title.industries') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('industry::industries.title.industries') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.industry.industry.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('industry::industries.button.create industry') }}
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
                                <th>{{ trans('industry::industries.table.title') }}</th>
                                <th>{{ trans('industry::industries.table.author') }}</th>
                                <th>{{ trans('industry::industries.table.content') }}</th>
                                <th>{{ trans('industry::industries.table.status') }}</th>
                                <th>{{ trans('industry::industries.table.category') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($industries)): ?>
                            <?php foreach ($industries as $industry): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.industry.industry.edit', [$industry->id]) }}">
                                        {{ $industry->id }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('admin.industry.industry.edit', [$industry->id]) }}">
                                        {{ $industry->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.industry.industry.edit', [$industry->id]) }}">
                                        {{ $industry->author }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.industry.industry.edit', [$industry->id]) }}">
                                        {{ $industry->content }}
                                    </a>
                                </td>
                                
                                
                                <td>
                                    <span class="label {{ $industry->present()->statusLabelClass }}">
                                        {{ $industry->present()->status }}
                                    </span>
                                </td>
                                
                                        <?php foreach ($categories as $id => $category): ?>
                                     @if($industry->category_id == $id) 
                              <td>
                                        <a href="{{ route('admin.industry.industry.edit', [$industry->id]) }}">
                                        {{ $category }}
                                    </a>
                                </td>
                               @endif
                                <?php endforeach; ?>
                                <td>
                                    <a href="{{ route('admin.industry.industry.edit', [$industry->id]) }}">
                                        {{ $industry->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.industry.industry.edit', [$industry->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.industry.industry.destroy', [$industry->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>{{ trans('industry::industries.table.title') }}</th>
                                <th>{{ trans('industry::industries.table.author') }}</th>
                                <th>{{ trans('industry::industries.table.content') }}</th>
                                <th>{{ trans('industry::industries.table.status') }}</th>
                                <th>{{ trans('industry::industries.table.category') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
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
        <dd>{{ trans('industry::industries.title.create industry') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.industry.industry.create') ?>" }
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
