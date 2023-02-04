<?php

namespace Modules\CaseStudies\Events;

use Modules\Media\Contracts\DeletingMedia;

class CaseStudiesWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $caseStudiesClass;
    /**
     * @var int
     */
    private $caseStudiesId;

    public function __construct($caseStudiesId, $caseStudiesClass)
    {
        $this->caseStudiesClass = $caseStudiesClass;
        $this->caseStudiesId = $caseStudiesId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->caseStudiesId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->caseStudiesClass;
    }
}
