<div class="form-group">
    <label for="{{ $settingName }}">{{ trans($moduleInfo['description']) }}</label>
    <select class="form-control" name="{{ $settingName }}" id="{{ $settingName }}">
            <option value="DESC" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == 'DESC' ? 'selected' : '' }}>
                DESC
            </option>
            <option value="ASC" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == 'ASC' ? 'selected' : '' }}>
                ASC
            </option>
    </select>
</div>
