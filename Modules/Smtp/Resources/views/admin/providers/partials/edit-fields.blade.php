<div class="box-body">
    <div class='form-group{{ $errors->has('provider_name') ? ' has-error' : '' }}'>
        {!! Form::label('provider_name', trans('smtp::providers.form.provider_name')) !!}
        {!! Form::text('provider_name', old('provider_name', $provider->provider_name), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.provider_name')]) !!}
        {!! $errors->first('provider_name', '<span class="help-block">:message</span>') !!}
    </div>

    <div class="form-group">
    {!! Form::label('email_encryption', trans('smtp::providers.form.email_encryption')) !!}
                        <select name="email_encryption" id="email_encryption" class="form-control">
                            <option value="none" selected>None</option>
                            <option value="SSL" {{ old('email_encryption', $provider->email_encryption) == 'SSL' ? 'selected' : '' }}>SSL</option>
                            <option value="TLS" {{ old('email_encryption', $provider->email_encryption) == 'TLS' ? 'selected' : '' }}>TLS</option>
                        </select>
                    </div>


    <div class='form-group{{ $errors->has('smtp_host') ? ' has-error' : '' }}'>
        {!! Form::label('smtp_host', trans('smtp::providers.form.smtp_host')) !!}
        {!! Form::text('smtp_host', old('smtp_host', $provider->smtp_host), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.smtp_host')]) !!}
        {!! $errors->first('smtp_host', '<span class="help-block">:message</span>') !!}
    </div>


    <div class='form-group{{ $errors->has('smtp_port') ? ' has-error' : '' }}'>
        {!! Form::label('smtp_port', trans('smtp::providers.form.smtp_port')) !!}
        {!! Form::text('smtp_port', old('smtp_port', $provider->smtp_port), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.smtp_port')]) !!}
        {!! $errors->first('smtp_port', '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has('email') ? ' has-error' : '' }}'>
        {!! Form::label('email', trans('smtp::providers.form.email')) !!}
        {!! Form::text('email', old('email', $provider->email), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.email')]) !!}
        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
    </div>


    <div class='form-group{{ $errors->has('user_name') ? ' has-error' : '' }}'>
        {!! Form::label('user_name', trans('smtp::providers.form.user_name')) !!}
        {!! Form::text('user_name', old('user_name', $provider->user_name), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.user_name')]) !!}
        {!! $errors->first('user_name', '<span class="help-block">:message</span>') !!}
    </div>


    <div class='form-group{{ $errors->has('password') ? ' has-error' : '' }}'>
        {!! Form::label('password', trans('smtp::providers.form.password')) !!}
        {!! Form::text('password', old('password', $provider->password), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.password')]) !!}
        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
    </div>


    <div class='form-group{{ $errors->has('email_charset') ? ' has-error' : '' }}'>
        {!! Form::label('email_charset', trans('smtp::providers.form.email_charset')) !!}
        {!! Form::text('email_charset', old('email_charset', $provider->email_charset), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.email_charset')]) !!}
        {!! $errors->first('email_charset', '<span class="help-block">:message</span>') !!}
    </div>

    


    <div class='form-group{{ $errors->has('others') ? ' has-error' : '' }}'>
        {!! Form::label('others', trans('smtp::providers.form.others')) !!}
        {!! Form::text('others', old('others', $provider->others), ['class' => 'form-control', 'placeholder' => trans('smtp::providers.form.others')]) !!}
        {!! $errors->first('others', '<span class="help-block">:message</span>') !!}
    </div>
    

</div>