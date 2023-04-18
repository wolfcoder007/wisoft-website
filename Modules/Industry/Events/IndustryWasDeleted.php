<?php

namespace Modules\Industry\Events;

use Modules\Media\Contracts\DeletingMedia;

class IndustryWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $industryClass;
    /**
     * @var int
     */
    private $industryId;

    public function __construct($industryId, $industryClass)
    {
        $this->industryClass = $industryClass;
        $this->industryId = $industryId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->industryId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->industryClass;
    }
}
