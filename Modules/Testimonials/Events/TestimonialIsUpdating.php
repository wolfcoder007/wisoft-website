<?php

namespace Modules\Testimonials\Events;

use Modules\Testimonials\Entities\Testimonial;
use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class TestimonialIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Testimonial
     */
    private $testimonial;

    public function __construct(Testimonial $testimonial, array $data)
    {
        parent::__construct($data);

        $this->testimonial = $testimonial;
    }

    /**
     * @return Testimonial
     */
    public function getTestimonial()
    {
        return $this->testimonial;
    }
}
