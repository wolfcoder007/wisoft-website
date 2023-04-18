<?php

namespace Modules\Industry\Events;

use Modules\Industry\Entities\Industry;
use Modules\Media\Contracts\StoringMedia;

class IndustryWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Testimonial
     */
    public $industry;

    public function __construct($industry, array $data)
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
