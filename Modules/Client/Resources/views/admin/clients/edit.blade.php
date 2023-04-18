@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('client::clients.title.edit client') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.client.client.index') }}">{{ trans('client::clients.title.clients') }}</a></li>
        <li class="active">{{ trans('client::clients.title.edit client') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.client.client.update', $client->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('client::admin.clients.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.client.client.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-2">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label("category", 'Category:') !!}
                        <select name="category_id" id="category" class="form-control">
                            <?php foreach ($categories as $id => $category): ?>
                            <option value="{{ $id }}" {{ old('category_id', $client->category_id) == $id ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label("status", 'Post status:') !!}
                            <select name="status" id="status" class="form-control">
                            <?php foreach ($statuses as $id => $status): ?>
                            <option value="{{ $id }}" {{ old('status', $client->status) == $id ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    @mediaSingle('thumbnail', $client)
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
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.client.client.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
