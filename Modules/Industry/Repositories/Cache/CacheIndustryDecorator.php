<?php

namespace Modules\Industry\Repositories\Cache;

use Modules\Industry\Repositories\IndustryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheIndustryDecorator extends BaseCacheDecorator implements IndustryRepository
{
    public function __construct(IndustryRepository $industry)
    {
        parent::__construct();
        $this->entityName = 'industry.industries';
        $this->repository = $industry;
    }
}
