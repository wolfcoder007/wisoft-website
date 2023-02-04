<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('casestudies::casestudies.form.title')) !!}
        <?php $old = $casestudies->hasTranslation($lang) ? $casestudies->translate($lang)->title : '' ?>
        {!! Form::text("{$lang}[title]", old("$lang.title", $casestudies->title), ['class' => 'form-control', 'data-slug' => 'source',  'placeholder' => trans('casestudies::casestudies.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.author") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[author]", trans('casestudies::casestudies.form.author')) !!}
       {!! Form::text("{$lang}[author]", old("$lang.author", $casestudies->author), ['class' => 'form-control author', 'data-author' => 'target', 'placeholder' => trans('casestudies::casestudies.form.author')]) !!}
       {!! $errors->first("$lang.author", '<span class="help-block">:message</span>') !!}
    </div>

    
    @editor('content', trans('casestudies::casestudies.form.content'), old("{$lang}.content",  $casestudies->content), $lang)

    <?php if (config('asgard.blog.config.post.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.create') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
