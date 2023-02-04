<?php

namespace Modules\Testimonials\Events;

use Modules\Testimonials\Entities\Testimonial;
use Modules\Media\Contracts\StoringMedia;

class TestimonialWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Testimonial
     */
    public $testimonial;

    public function __construct($testimonial, array $data)
    {
        $this->data = $data;
        $this->testimonial = $testimonial;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->testimonial;
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
