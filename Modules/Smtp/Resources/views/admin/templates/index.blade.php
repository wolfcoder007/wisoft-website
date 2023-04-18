@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('smtp::templates.title.templates') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('smtp::templates.title.templates') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.smtp.template.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('smtp::templates.button.create template') }}
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
                                <th>{{ trans('smtp::templates.form.name') }}</th>
                                <th>{{ trans('smtp::templates.form.body') }}</th>
                                <th>{{ trans('smtp::templates.form.template_info') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($templates)): ?>
                            <?php foreach ($templates as $template): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.smtp.template.edit', [$template->id]) }}">
                                        {{ $template->template_name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.smtp.template.edit', [$template->id]) }}">
                                        {{ $template->body }}
                                    </a>
                                </td>
                                <td>
                                    <dl class="dl-horizontal">
                                        <dt>{{ trans('smtp::templates.form.email_to') }}</dt>
                                        <dd>{{ $template->email_to }}</dd>
                                        <dt>{{ trans('smtp::templates.form.email_form') }}</dt>
                                        <dd>{{ $template->email_form }}</dd>
                                        <dt>{{ trans('smtp::templates.form.subject') }}</dt>
                                        <dd>{{ $template->subject }}</dd>
                                        <dt>{{ trans('smtp::templates.form.header') }}</dt>
                                        <dd>{{ $template->header }}</dd>
                                        <dt>{{ trans('smtp::templates.form.provider') }}</dt>
                                        <dd>{{ $template->provider_id }}</dd>
                                    </dl>

                                </td>
                                <td>
                                    <a href="{{ route('admin.smtp.template.edit', [$template->id]) }}">
                                        {{ $template->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.smtp.template.edit', [$template->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.smtp.template.destroy', [$template->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('smtp::templates.form.name') }}</th>
                                <th>{{ trans('smtp::templates.form.body') }}</th>
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
        <dd>{{ trans('smtp::templates.title.create template') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.smtp.template.create') ?>" }
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
