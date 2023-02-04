<div class="form-group">
    <label for="{{ $settingName }}">{{ trans($moduleInfo['description']) }}</label>
   <select class="form-control" name="{{ $settingName }}" id="{{ $settingName }}">
            <option value="created_at" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == 'date' ? 'selected' : '' }}>
                Date
            </option>
            <option value="custom_order" {{ isset($dbSettings[$settingName]) && $dbSettings[$settingName]->plainValue == 'custom_order' ? 'selected' : '' }}>
                Custom order
            </option>
    </select>
</div>
