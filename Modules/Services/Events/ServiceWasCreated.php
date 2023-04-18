<?php

namespace Modules\Services\Events;

use Modules\Services\Entities\Testimonial;
use Modules\Media\Contracts\StoringMedia;

class ServiceWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Testimonial
     */
    public $service;

    public function __construct($service, array $data)
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
