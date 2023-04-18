<?php

namespace Modules\Services\Events;

use Modules\Services\Entities\Service;
use Modules\Media\Contracts\StoringMedia;

class ServiceWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Service
     */
    public $service;

    public function __construct(Service $service, array $data)
    {
        $this->data = $data;
        $this->service = $service;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->service;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
