<?php

namespace Modules\Smtp\Repositories\Cache;

use Modules\Smtp\Repositories\ProviderRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProviderDecorator extends BaseCacheDecorator implements ProviderRepository
{
    public function __construct(ProviderRepository $provider)
    {
        parent::__construct();
        $this->entityName = 'smtp.providers';
        $this->repository = $provider;
    }
}
