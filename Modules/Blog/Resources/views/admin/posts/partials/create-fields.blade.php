<div class="box-body">
    <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[title]", trans('blog::post.form.title')) !!}
        {!! Form::text("{$lang}[title]", old("$lang.title"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('blog::post.form.title')]) !!}
        {!! $errors->first("$lang.title", '<span class="help-block">:message</span>') !!}
    </div>
    <div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
       {!! Form::label("{$lang}[slug]", trans('blog::post.form.slug')) !!}
       {!! Form::text("{$lang}[slug]", old("$lang.slug"), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('blog::post.form.slug')]) !!}
       {!! $errors->first("$lang.slug", '<span class="help-block">:message</span>') !!}
    </div>

    @editor('content', trans('blog::post.form.content'), old("{$lang}.content"), $lang)

    <?php if (config('asgard.blog.config.post.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.blog.config.post.partials.translatable.create') as $partial): ?>
        @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>


<div class="box-body">
    
    <div class="box-group" id="accordion">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{$lang}}">
                        {{ trans('page::pages.meta_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseTwo-{{$lang}}" class="panel-collapse collapse">
                <div class="box-body">
                    <div class='form-group{{ $errors->has("{$lang}[meta_title]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[meta_title]", trans('page::pages.meta_title')) !!}
                        {!! Form::text("{$lang}[meta_title]", old("$lang.meta_title"), ['class' => "form-control", 'placeholder' => trans('page::pages.meta_title')]) !!}
                        {!! $errors->first("{$lang}[meta_title]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[meta_description]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[meta_description]", trans('page::pages.meta_description')) !!}
                        <textarea class="form-control" name="{{$lang}}[meta_description]" rows="10" cols="80">{{ old("$lang.meta_description") }}</textarea>
                        {!! $errors->first("{$lang}[meta_description]", '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFacebook-{{$lang}}">
                        {{ trans('page::pages.facebook_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseFacebook-{{$lang}}" class="panel-collapse collapse">
                <div class="box-body">
                    <div class='form-group{{ $errors->has("{$lang}[fb_title]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[fb_title]", trans('page::pages.fb_title')) !!}
                        {!! Form::text("{$lang}[fb_title]", old("{$lang}.fb_title"), ['class' => "form-control", 'placeholder' => trans('page::pages.fb_title')]) !!}
                        {!! $errors->first("{$lang}[fb_title]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[fb_description]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[fb_description]", trans('page::pages.fb_description')) !!}
                        <textarea class="form-control" name="{{$lang}}[fb_description]" rows="10" cols="80">{{ old("$lang.fb_description") }}</textarea>
                        {!! $errors->first("{$lang}[fb_description]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group{{ $errors->has("{$lang}[fb_type]") ? ' has-error' : '' }}">
                        <label>{{ trans('page::pages.fb_type') }}</label>
                        <select class="form-control" name="{{ $lang }}[fb_type]">
                            <option value="website" {{ old("$lang.fb_type") == 'website' ? 'selected' : '' }}>{{ trans('page::pages.facebook-types.website') }}</option>
                            <option value="product" {{ old("$lang.fb_type") == 'product' ? 'selected' : '' }}>{{ trans('page::pages.facebook-types.product') }}</option>
                            <option value="article" {{ old("$lang.fb_type") == 'article' ? 'selected' : '' }}>{{ trans('page::pages.facebook-types.article') }}</option>
                        </select>
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[fb_vedio_url]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[fb_vedio_url]", trans('page::pages.fb_vedio_url')) !!}
                        {!! Form::text("{$lang}[fb_vedio_url]", old("{$lang}.fb_url"), ['class' => "form-control", 'placeholder' => trans('page::pages.fb_vedio_url')]) !!}
                        {!! $errors->first("{$lang}[fb_vedio_url]", '<span class="help-block">:message</span>') !!}
                    </div>
                    
                @mediaSingle('fb_image')
                </div>
            </div>
        </div>
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwitter-{{$lang}}">
                        {{ trans('page::pages.twitter_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseTwitter-{{$lang}}" class="panel-collapse collapse">
                <div class="box-body">
                    <div class='form-group{{ $errors->has("{$lang}[tw_title]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[tw_title]", trans('page::pages.tw_title')) !!}
                        {!! Form::text("{$lang}[tw_title]", old("{$lang}.tw_title"), ['class' => "form-control", 'placeholder' => trans('page::pages.tw_title')]) !!}
                        {!! $errors->first("{$lang}[tw_title]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[tw_description]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[tw_description]", trans('page::pages.tw_description')) !!}
                        <textarea class="form-control" name="{{$lang}}[tw_description]" rows="10" cols="80">{{ old("$lang.tw_description") }}</textarea>
                        {!! $errors->first("{$lang}[tw_description]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[tw_card]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[tw_card]", trans('page::pages.tw_card')) !!}
                        {!! Form::text("{$lang}[tw_card]", old("{$lang}.tw_card"), ['class' => "form-control", 'placeholder' => trans('page::pages.tw_card')]) !!}
                        {!! $errors->first("{$lang}[tw_card]", '<span class="help-block">:message</span>') !!}
                    </div>
                    
                @mediaSingle('tw_image')
                </div>
            </div>
            
        </div>

        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseAdvance-{{$lang}}">
                        {{ trans('page::pages.advance') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseAdvance-{{$lang}}" class="panel-collapse collapse">
                <div class="box-body">
                    <div class='form-group{{ $errors->has("{$lang}[cononical_url]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[cononical_url]", trans('page::pages.cononical_url')) !!}
                        {!! Form::text("{$lang}[cononical_url]", old("$lang.cononical_url"), ['class' => "form-control", 'placeholder' => trans('page::pages.cononical_url')]) !!}
                        {!! $errors->first("{$lang}[cononical_url]", '<span class="help-block">:message</span>') !!}
                    </div>
                    
                </div>
            </div>
        </div>


    </div>
</div>
