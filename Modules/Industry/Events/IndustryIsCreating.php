<?php

namespace Modules\Industry\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class IndustryIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
