<?php

namespace Modules\Block\Events;

use Modules\Block\Entities\Block;
use Modules\Media\Contracts\StoringMedia;

class BlockWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Block
     */
    public $block;

    public function __construct($block, array $data)
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
