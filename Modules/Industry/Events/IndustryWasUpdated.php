<?php

namespace Modules\Industry\Events;

use Modules\Industry\Entities\Industry;
use Modules\Media\Contracts\StoringMedia;

class IndustryWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Service
     */
    public $industry;

    public function __construct(Industry $industry, array $data)
    {
        $this->data = $data;
        $this->industry = $industry;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->industry;
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
