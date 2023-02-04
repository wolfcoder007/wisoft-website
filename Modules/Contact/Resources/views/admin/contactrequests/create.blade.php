@extends('layouts.master')

@section('content-header')
<h1>
    {{ trans('contact::contact.create') }}
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
    <li><a href="{{ route('admin.contact.contactrequest.index') }}">{{ trans('contact::contactrequests.title.contactrequests') }}</a></li>
    <li>{{ trans('contact::contact.create') }}</li>
</ol>
@stop

@section('styles')
@stop

@section('content')
{!! Form::open(['route' => ['admin.contact.contactrequest.store'], 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans('core::core.title.non translatable fields') }}</h3>
            </div>
            <div class="box-body">
            <div class='form-group{{ $errors->has('name') ? ' has-error' : '' }}'>
                    {!! Form::label('name', trans('contact::contact.full-name')) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('contact::contact.full-name')]) !!}
                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                </div>

                <div class='form-group{{ $errors->has('email') ? ' has-error' : '' }}'>
                    {!! Form::label('email', trans('contact::contact.email')) !!}
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('contact::contact.email')]) !!}
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>

                <div class='form-group{{ $errors->has('company') ? ' has-error' : '' }}'>
                    {!! Form::label('company', trans('contact::contact.company')) !!}
                    {!! Form::text('company', old('company'), ['class' => 'form-control', 'placeholder' => trans('contact::contact.company')]) !!}
                    {!! $errors->first('company', '<span class="help-block">:message</span>') !!}
                </div>

                <div class='form-group{{ $errors->has('phone') ? ' has-error' : '' }}'>
                    {!! Form::label('phone', trans('contact::contact.phone')) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => trans('contact::contact.phone')]) !!}
                    {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                </div>

                <div class='form-group{{ $errors->has('message') ? ' has-error' : '' }}'>
                    {!! Form::label('message', trans('contact::contact.message')) !!}
                    {!! Form::text('message', old('message'), ['class' => 'form-control', 'placeholder' => trans('contact::contact.message')]) !!}
                    {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
                </div>

                

            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
            <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
            <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.slider.slider.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop

@section('footer')
@stop
@section('shortcuts')
@stop

@section('scripts')
<script>
$( document ).ready(function() {
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>
@stop
