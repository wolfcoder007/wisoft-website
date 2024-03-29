@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('page::pages.create page') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ URL::route('admin.page.page.index') }}">{{ trans('page::pages.pages') }}</a></li>
        <li class="active">{{ trans('page::pages.create page') }}</li>
    </ol>
@stop

@section('styles')
    <style>
        .checkbox label {
            padding-left: 0;
        }
        .div {
            display:none !important;
        }
    </style>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.page.page.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers', ['fields' => ['title', 'body']])
                <div class="tab-content">
                    <?php $i = 0; ?>
                    <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                    <?php ++$i; ?>
                    <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                        @include('page::admin.partials.create-fields', ['lang' => $locale])
                    </div>
                    <?php endforeach; ?>
                    <?php if (config('asgard.page.config.partials.normal.create') !== []): ?>
                        <?php foreach (config('asgard.page.config.partials.normal.create') as $partial): ?>
                            @include($partial)
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.page.page.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-2">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="checkbox{{ $errors->has('is_home') ? ' has-error' : '' }}">
                        <input type="hidden" name="is_home" value="0">
                        <label for="is_home">
                            <input id="is_home"
                                   name="is_home"
                                   type="checkbox"
                                   class="flat-blue"
                                   value="1" />
                            {{ trans('page::pages.is homepage') }}
                            {!! $errors->first('is_home', '<span class="help-block">:message</span>') !!}
                        </label>
                    </div>
                    <hr/>
                    <div class="checkbox{{ $errors->has('status') ? ' has-error' : '' }}">
                        <input type="hidden" name="status" value="1" checked>
                        <label for="status">
                            <input id="status"
                                   name="status"
                                   type="checkbox"
                                   class="flat-blue"
                                   value="1" />
                            {{ trans('page::pages.status') }}
                            {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                        </label>
                    </div>
                    <hr/>
                    <div class='form-group{{ $errors->has("template") ? ' has-error' : '' }}'>
                        {!! Form::label("template", trans('page::pages.template')) !!}
                        {!! Form::select("template", $all_templates, old("template", 'default'), ['class' => "form-control", 'placeholder' => trans('page::pages.template')]) !!}
                        {!! $errors->first("template", '<span class="help-block">:message</span>') !!}
                    </div>

                @mediaSingle('image')
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('page::pages.navigation.back to index') }}</dd>
    </dl>
@stop

@section('scripts')
    <script>
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.page.page.index') ?>" }
                ]
            });
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
        <script>
    
</script>

    </script>
@stop