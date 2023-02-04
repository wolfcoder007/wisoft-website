<?php

namespace Modules\Testimonials\Events;

use Modules\Media\Contracts\DeletingMedia;

class TestimonialWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $testimonialClass;
    /**
     * @var int
     */
    private $testimonialId;

    public function __construct($testimonialId, $testimonialClass)
    {
        $this->testimonialClass = $testimonialClass;
        $this->testimonialId = $testimonialId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->testimonialId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->testimonialClass;
    }
}
