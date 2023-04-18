<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('industry::industries.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('industry::industries.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.author") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[author]", trans('industry::industries.form.author')) !!}
       {!! Form::text("{$lang}[author]", old("$lang.slug"), ['class' => 'form-control author', 'data-author' => 'target', 'placeholder' => trans('industry::industries.form.author')]) !!}
       {!! $errors->first("$lang.author", '<span class="help-block">:message</span>') !!}
    </div>


    @editor('content', trans('industry::industries.form.content'), old("{$lang}.content"), $lang)

    <?php if (config('asgard.industry.config.industry.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.industry.config.industry.partials.translatable.create') as $partial): ?>
            @include($partial) 
        <?php endforeach; ?>
    <?php endif; ?>
</div>