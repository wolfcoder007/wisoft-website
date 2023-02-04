<?php

namespace Modules\CaseStudies\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class CaseStudiesIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
