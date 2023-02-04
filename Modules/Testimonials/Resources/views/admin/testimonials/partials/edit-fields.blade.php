<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('testimonials::testimonials.form.title')) !!}
        <?php $old = $testimonial->hasTranslation($lang) ? $testimonial->translate($lang)->title : '' ?>
        {!! Form::text("{$lang}[title]", old("$lang.title", $testimonial->title), ['class' => 'form-control', 'data-slug' => 'source',  'placeholder' => trans('testimonials::testimonials.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.author") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[author]", trans('testimonials::testimonials.form.author')) !!}
       {!! Form::text("{$lang}[author]", old("$lang.author", $testimonial->author), ['class' => 'form-control author', 'data-author' => 'target', 'placeholder' => trans('testimonials::testimonials.form.author')]) !!}
       {!! $errors->first("$lang.author", '<span class="help-block">:message</span>') !!}
    </div>

    
    @editor('content', trans('testimonials::testimonials.form.content'), old("{$lang}.content",  $testimonial->content), $lang)

    <?php if (config('asgard.blog.config.post.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.create') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>
