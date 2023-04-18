<?php

namespace Modules\Client\Events;

use Modules\Media\Contracts\DeletingMedia;

class ClientWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $clientClass;
    /**
     * @var int
     */
    private $clientId;

    public function __construct($clientId, $clientClass)
    {
        $this->clientClass = $clientClass;
        $this->clientId = $clientId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->clientId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->clientClass;
    }
}
