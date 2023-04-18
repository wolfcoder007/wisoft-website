<?php

namespace Modules\Client\Events;

use Modules\Client\Entities\Client;
use Modules\Media\Contracts\StoringMedia;

class ClientWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Service
     */
    public $client;

    public function __construct(Client $client, array $data)
    {
        $this->data = $data;
        $this->client = $client;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->client;
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
