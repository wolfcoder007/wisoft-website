<div class="box-body">
    <div class="box-body">
        <div class='form-group{{ $errors->has("{$lang}.title") ? ' has-error' : '' }}'>
            {!! Form::label("{$lang}[title]", trans('page::pages.title')) !!}
            <?php $old = $page->hasTranslation($lang) ? $page->translate($lang)->title : '' ?>
            {!! Form::text("{$lang}[title]", old("{$lang}.title", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('page::pages.title')]) !!}
            {!! $errors->first("{$lang}.title", '<span class="help-block">:message</span>') !!}
        </div>
        <div class='form-group{{ $errors->has("{$lang}[slug]") ? ' has-error' : '' }}'>
            {!! Form::label("{$lang}[slug]", trans('page::pages.slug')) !!}
            <?php $old = $page->hasTranslation($lang) ? $page->translate($lang)->slug : '' ?>
            {!! Form::text("{$lang}[slug]", old("{$lang}.slug", $old), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('page::pages.slug')]) !!}
            {!! $errors->first("{$lang}.slug", '<span class="help-block">:message</span>') !!}
        </div>

        <?php $old = $page->hasTranslation($lang) ? $page->translate($lang)->body : '' ?>
        @editor('body', trans('page::pages.body'), old("$lang.body", $old), $lang)

        <?php if (config('asgard.page.config.partials.translatable.edit') !== []): ?>
            <?php foreach (config('asgard.page.config.partials.translatable.edit') as $partial): ?>
                @include($partial)
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
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
                        <?php $old = $page->hasTranslation($lang) ? $page->translate($lang)->meta_title : '' ?>
                        {!! Form::text("{$lang}[meta_title]", old("{$lang}.meta_title", $old), ['class' => "form-control", 'placeholder' => trans('page::pages.meta_title')]) !!}
                        {!! $errors->first("{$lang}[meta_title]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[meta_description]") ? ' has-error' : '' }}'>
                        {!! Form::label("{$lang}[meta_description]", trans('page::pages.meta_description')) !!}
                        <?php $old = $page->hasTranslation($lang) ? $page->translate($lang)->meta_description : '' ?>
                        <textarea class="form-control" name="{{$lang}}[meta_description]" rows="10" cols="80">{{ old("$lang.meta_description", $old) }}</textarea>
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
                    <?php $oldTitle = isset($page->translate($lang)->fb_title) ? $page->translate($lang)->fb_title : ''; ?>
                        {!! Form::label("{$lang}[fb_title]", trans('page::pages.fb_title')) !!}
                        {!! Form::text("{$lang}[fb_title]", old("{$lang}.fb_title", $oldTitle), ['class' => "form-control", 'placeholder' => trans('page::pages.fb_title')]) !!}
                        {!! $errors->first("{$lang}[fb_title]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[fb_description]") ? ' has-error' : '' }}'>
                    <?php $old_desc = isset($page->translate($lang)->fb_description) ? $page->translate($lang)->fb_description : ''; ?>
                        {!! Form::label("{$lang}[fb_description]", trans('page::pages.fb_description')) !!}
                        <textarea class="form-control" name="{{$lang}}[fb_description]" rows="10" cols="80">{{ old("$lang.fb_description", $old_desc) }}</textarea>
                        {!! $errors->first("{$lang}[fb_description]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group{{ $errors->has("{$lang}[fb_type]") ? ' has-error' : '' }}">
                    <?php $oldType = $page->hasTranslation($lang) ? $page->translate($lang)->fb_type : '' ?>
                        <?php $oldType = null !== old("$lang.fb_type") ? old("$lang.fb_type") : $oldType; ?>
                        <label>{{ trans('page::pages.fb_type') }}</label>
                        <select class="form-control" name="{{ $lang }}[fb_type]">
                            <option value="website" {{ old("$lang.fb_type",$oldType) == 'website' ? 'selected' : '' }}>{{ trans('page::pages.facebook-types.website') }}</option>
                            <option value="product" {{ old("$lang.fb_type",$oldType) == 'product' ? 'selected' : '' }}>{{ trans('page::pages.facebook-types.product') }}</option>
                            <option value="article" {{ old("$lang.fb_type",$oldType) == 'article' ? 'selected' : '' }}>{{ trans('page::pages.facebook-types.article') }}</option>
                            
                        </select>
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[fb_vedio_url]") ? ' has-error' : '' }}'>
                    <?php $old_url = isset($page->translate($lang)->fb_vedio_url) ? $page->translate($lang)->fb_vedio_url : ''; ?>
                        {!! Form::label("{$lang}[fb_vedio_url]", trans('page::pages.fb_vedio_url')) !!}
                        {!! Form::text("{$lang}[fb_vedio_url]", old("{$lang}.fb_url", $old_url), ['class' => "form-control", 'placeholder' => trans('page::pages.fb_vedio_url')]) !!}
                        {!! $errors->first("{$lang}[fb_vedio_url]", '<span class="help-block">:message</span>') !!}
                    </div>
                    
                @mediaSingle('fb_image', $page)
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
                    <?php $oldTitle = isset($page->translate($lang)->tw_title) ? $page->translate($lang)->tw_title : ''; ?>
                        {!! Form::label("{$lang}[tw_title]", trans('page::pages.tw_title')) !!}
                        {!! Form::text("{$lang}[tw_title]", old("{$lang}.tw_title", $oldTitle), ['class' => "form-control", 'placeholder' => trans('page::pages.tw_title')]) !!}
                        {!! $errors->first("{$lang}[tw_title]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[tw_description]") ? ' has-error' : '' }}'>
                    <?php $olddesc = isset($page->translate($lang)->tw_description) ? $page->translate($lang)->tw_description : ''; ?>
                        {!! Form::label("{$lang}[tw_description]", trans('page::pages.tw_description')) !!}
                        <textarea class="form-control" name="{{$lang}}[tw_description]" rows="10" cols="80">{{ old("$lang.tw_description", $olddesc) }}</textarea>
                        {!! $errors->first("{$lang}[tw_description]", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("{$lang}[tw_card]") ? ' has-error' : '' }}'>
                    <?php $oldcard = isset($page->translate($lang)->tw_card) ? $page->translate($lang)->tw_card : ''; ?>
                        {!! Form::label("{$lang}[tw_card]", trans('page::pages.tw_card')) !!}
                        {!! Form::text("{$lang}[tw_card]", old("{$lang}.tw_card", $oldcard), ['class' => "form-control", 'placeholder' => trans('page::pages.tw_card')]) !!}
                        {!! $errors->first("{$lang}[tw_card]", '<span class="help-block">:message</span>') !!}
                    </div>
                               
                @mediaSingle('tw_image', $page)
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
                    <?php $oldurl = isset($page->translate($lang)->cononical_url) ? $page->translate($lang)->cononical_url : ''; ?>
                        {!! Form::label("{$lang}[cononical_url]", trans('page::pages.cononical_url')) !!}
                        {!! Form::text("{$lang}[cononical_url]", old("$lang.cononical_url", $oldurl), ['class' => "form-control", 'placeholder' => trans('page::pages.cononical_url')]) !!}
                        {!! $errors->first("{$lang}[cononical_url]", '<span class="help-block">:message</span>') !!}
                    </div>
                    
                </div>
            </div>
        </div>




    </div>
</div>
