<?php

namespace Modules\Services\Events;

use Modules\Media\Contracts\DeletingMedia;

class ServiceWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $serviceClass;
    /**
     * @var int
     */
    private $serviceId;

    public function __construct($serviceId, $serviceClass)
    {
        $this->serviceClass = $serviceClass;
        $this->serviceId = $serviceId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->serviceId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->serviceClass;
    }
}
