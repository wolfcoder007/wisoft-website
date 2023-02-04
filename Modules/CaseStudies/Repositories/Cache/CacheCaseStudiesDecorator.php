<?php

namespace Modules\CaseStudies\Repositories\Cache;

use Modules\CaseStudies\Repositories\CaseStudiesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCaseStudiesDecorator extends BaseCacheDecorator implements CaseStudiesRepository
{
    public function __construct(CaseStudiesRepository $casestudies)
    {
        parent::__construct();
        $this->entityName = 'casestudies.casestudies';
        $this->repository = $casestudies;
    }
}
