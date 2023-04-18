<?php

namespace Modules\Industry\Events;

use Modules\Industry\Entities\Industry;
use Modules\Core\Contracts\EntityIsChanging;
use Modules\Core\Events\AbstractEntityHook;

class IndustryIsUpdating extends AbstractEntityHook implements EntityIsChanging
{
    /**
     * @var Industry
     */
    private $industry;

    public function __construct(Industry $industry, array $data)
    {
        parent::__construct($data);

        $this->industry = $industry;
    }

    /**
     * @return Industry
     */
    public function getIndustry()
    {
        return $this->industry;
    }
}
