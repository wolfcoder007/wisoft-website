<?php

namespace Modules\Smtp\Repositories\Cache;

use Modules\Smtp\Repositories\TemplateRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTemplateDecorator extends BaseCacheDecorator implements TemplateRepository
{
    public function __construct(TemplateRepository $template)
    {
        parent::__construct();
        $this->entityName = 'smtp.templates';
        $this->repository = $template;
    }
}
