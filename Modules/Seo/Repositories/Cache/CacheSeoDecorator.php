<?php

namespace Modules\Seo\Repositories\Cache;

use Modules\Seo\Repositories\SeoRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheSeoDecorator extends BaseCacheDecorator implements SeoRepository
{
    public function __construct(SeoRepository $seo)
    {
        parent::__construct();
        $this->entityName = 'seo.seos';
        $this->repository = $seo;
    }
}
