@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('seo::seos.title.seos') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('seo::seos.title.seos') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.seo.seo.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('seo::seos.button.create seo') }}
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
                                <th>{{ trans('seo::seos.table.title') }}</th>
                                <th>{{ trans('seo::seos.table.type') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!--- default page ---->
                            <?php if (isset($seos)): ?>
                            <?php foreach ($seos as $seo): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$seo->id]) }}">
                                        {{ $seo->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$seo->id]) }}">
                                        {{ $seo->file_type }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$seo->id]) }}">
                                        {{ $seo->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.seo.seo.edit', [$seo->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <!--- pages-->
                            <?php if (isset($pages)): ?>
                            <?php foreach ($pages as $page): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$page->id]) }}">
                                        {{ $page->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$page->id]) }}">
                                        Page
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$page->id]) }}">
                                        {{ $page->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.seo.seo.edit', [$page->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            
                            
                            <!--- blog post-->
                            <?php if (isset($posts)): ?>
                            <?php foreach ($posts as $post): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$post->id]) }}">
                                        Blog
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.seo.seo.edit', [$post->id]) }}">
                                        {{$post->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.seo.seo.edit', [$post->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('seo::seos.table.title') }}</th>
                                <th>{{ trans('seo::seos.table.type') }}</th>
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
        <dd>{{ trans('seo::seos.title.create seo') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.seo.seo.create') ?>" }
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
