<?php

namespace Modules\Block\Events;

use Modules\Media\Contracts\DeletingMedia;

class BlockWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $blockClass;
    /**
     * @var int
     */
    private $blockId;

    public function __construct($blockId, $blockClass)
    {
        $this->blockClass = $blockClass;
        $this->blockId = $blockId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->blockId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->blockClass;
    }
}
