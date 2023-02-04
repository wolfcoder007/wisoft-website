<?php

namespace Modules\Testimonials\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class TestimonialIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
