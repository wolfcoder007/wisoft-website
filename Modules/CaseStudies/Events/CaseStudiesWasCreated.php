<?php

namespace Modules\CaseStudies\Events;

use Modules\CaseStudies\Entities\CaseStudies;
use Modules\Media\Contracts\StoringMedia;

class CaseStudiesWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Testimonial
     */
    public $caseStudies;

    public function __construct($caseStudies, array $data)
    {
        $this->data = $data;
        $this->caseStudies = $caseStudies;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->caseStudies;
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
