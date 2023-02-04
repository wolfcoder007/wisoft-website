<?php

namespace Modules\GeneralSettings\Repositories\Cache;

use Modules\GeneralSettings\Repositories\GeneralSettingRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheGeneralSettingDecorator extends BaseCacheDecorator implements GeneralSettingRepository
{
    public function __construct(GeneralSettingRepository $generalsetting)
    {
        parent::__construct();
        $this->entityName = 'generalsettings.generalsettings';
        $this->repository = $generalsetting;
    }
}
