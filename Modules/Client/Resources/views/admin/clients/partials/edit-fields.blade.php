<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('client::clients.form.title')) !!}
        <?php $old = $client->hasTranslation($lang) ? $client->translate($lang)->name : '' ?>
        {!! Form::text("{$lang}[title]", old("$lang.title", $client->name), ['class' => 'form-control', 'data-slug' => 'source',  'placeholder' => trans('client::clients.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    
</div>
