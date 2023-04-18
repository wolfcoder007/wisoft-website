<?php

namespace Modules\Client\Repositories\Cache;

use Modules\Client\Repositories\ClientRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheClientDecorator extends BaseCacheDecorator implements ClientRepository
{
    public function __construct(ClientRepository $client)
    {
        parent::__construct();
        $this->entityName = 'client.clients';
        $this->repository = $client;
    }
}
