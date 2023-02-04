<?php

namespace Modules\CaseStudies\Events;

use Modules\CaseStudies\Entities\CaseStudies;
use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class CaseStudiesIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Testimonial
     */
    private $caseStudies;

    public function __construct(CaseStudies $caseStudies, array $data)
    {
        parent::__construct($data);

        $this->caseStudies = $caseStudies;
    }

    /**
     * @return Testimonial
     */
    public function getCaseStudies()
    {
        return $this->caseStudies;
    }
}
