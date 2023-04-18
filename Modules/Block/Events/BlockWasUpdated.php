<?php

namespace Modules\Block\Events;

use Modules\Block\Entities\Block;
use Modules\Media\Contracts\StoringMedia;

class BlockWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Service
     */
    public $block;

    public function __construct(Block $block, array $data)
    {
        $this->data = $data;
        $this->block = $block;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->block;
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
