<?php

namespace Modules\Services\Events;

use Modules\Services\Entities\Service;
use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class ServiceIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Service
     */
    private $service;

    public function __construct(Service $service, array $data)
    {
        parent::__construct($data);

        $this->service = $service;
    }

    /**
     * @return Service
     */
    public function getservice()
    {
        return $this->service;
    }
}
