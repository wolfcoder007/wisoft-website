@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('smtp::providers.title.providers') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('smtp::providers.title.providers') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.smtp.provider.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('smtp::providers.button.create provider') }}
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
                                <th>{{ trans('smtp::providers.form.provider_name') }}</th>
                                <th>{{ trans('smtp::providers.form.provider_info') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($providers)): ?>
                            <?php foreach ($providers as $provider): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.smtp.provider.edit', [$provider->id]) }}">
                                        {{ $provider->provider_name }}
                                    </a>
                                </td>
                                <td>
                                <dl class="dl-horizontal">
                                    <dt>{{ trans('smtp::providers.form.email_encryption') }}</dt>
                                    <dd>{{ $provider->email_encryption }}</dd>
                                    <dt>{{ trans('smtp::providers.form.smtp_host') }}</dt>
                                    <dd>{{ $provider->smtp_host }}</dd>
                                    <dt>{{ trans('smtp::providers.form.smtp_port') }}</dt>
                                    <dd>{{ $provider->smtp_port }}</dd>
                                    <dt>{{ trans('smtp::providers.form.email') }}</dt>
                                    <dd><a href="mailto:{{ $provider->email }}">{{ $provider->email }}</a></dd>
                                    <dt>{{ trans('smtp::providers.form.user_name') }}</dt>
                                    <dd>{{ $provider->user_name }}</dd>
                                    <dt>{{ trans('smtp::providers.form.password') }}</dt>
                                    <dd>{{ $provider->password }}</dd>
                                    <dt>{{ trans('smtp::providers.form.email_charset') }}</dt>
                                    <dd>{{ $provider->email_charset }}</dd>
                                </dl>
                                
                                </td>
                                <td>
                                    <a href="{{ route('admin.smtp.provider.edit', [$provider->id]) }}">
                                        {{ $provider->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.smtp.provider.edit', [$provider->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.smtp.provider.destroy', [$provider->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            
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
        <dd>{{ trans('smtp::providers.title.create provider') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.smtp.provider.create') ?>" }
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
