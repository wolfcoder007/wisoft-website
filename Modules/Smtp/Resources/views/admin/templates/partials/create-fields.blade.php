<div class="box-body">
    <div class='form-group{{ $errors->has('template_name') ? ' has-error' : '' }}'>
        {!! Form::label('template_name', trans('smtp::templates.form.name')) !!}
        {!! Form::text('template_name', old('template_name'), ['class' => 'form-control', 'placeholder' => trans('smtp::templates.form.name')]) !!}
        {!! $errors->first('template_name', '<span class="help-block">:message</span>') !!}
    </div>
    
    <div class="form-group">
            {!! Form::label("provider_name", trans('smtp::templates.form.provider')) !!}
            <select name="provider_id" id="provider_id" class="form-control">
                <?php foreach ($providers as $provider): ?>
                    <option value="{{ $provider->id }}">{{ $provider->provider_name }}</option>
                <?php endforeach; ?>
            </select>
        </div>

    <div class='form-group{{ $errors->has('email_to') ? ' has-error' : '' }}'>
        {!! Form::label('email_to', trans('smtp::templates.form.email_to')) !!}
        {!! Form::text('email_to', old('email_to'), ['class' => 'form-control', 'placeholder' => trans('smtp::templates.form.email_to')]) !!}
        {!! $errors->first('email_to', '<span class="help-block">:message</span>') !!}
    </div>


    <div class='form-group{{ $errors->has('email_form') ? ' has-error' : '' }}'>
        {!! Form::label('email_form', trans('smtp::templates.form.email_form')) !!}
        {!! Form::text('email_form', old('email_form'), ['class' => 'form-control', 'placeholder' => trans('smtp::templates.form.email_form')]) !!}
        {!! $errors->first('email_form', '<span class="help-block">:message</span>') !!}
    </div>

    <div class='form-group{{ $errors->has('subject') ? ' has-error' : '' }}'>
        {!! Form::label('subject', trans('smtp::templates.form.subject')) !!}
        {!! Form::text('subject', old('subject'), ['class' => 'form-control', 'placeholder' => trans('smtp::templates.form.subject')]) !!}
        {!! $errors->first('subject', '<span class="help-block">:message</span>') !!}
    </div>


    <div class='form-group{{ $errors->has('header') ? ' has-error' : '' }}'>
        {!! Form::label('header', trans('smtp::templates.form.header')) !!}
        {!! Form::text('header', old('header'), ['class' => 'form-control', 'placeholder' => trans('smtp::templates.form.header')]) !!}
        {!! $errors->first('header', '<span class="help-block">:message</span>') !!}
    </div>
    
    

    @editor('body', trans('smtp::templates.form.body'))

    
</div>