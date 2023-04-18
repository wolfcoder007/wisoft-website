<?php

namespace Modules\Client\Events;

use Modules\Client\Entities\Client;
use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class ClientIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Block
     */
    private $client;

    public function __construct(Client $client, array $data)
    {
        parent::__construct($data);

        $this->client = $client;
    }

    /**
     * @return Block
     */
    public function getclient()
    {
        return $this->client;
    }
}
