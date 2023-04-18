<?php

namespace Modules\Services\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class ServiceIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
