<?php

namespace Modules\Client\Events;

use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class ClientIsCreating extends AbstractEntityHook implements EntityIsChanging
{
}
