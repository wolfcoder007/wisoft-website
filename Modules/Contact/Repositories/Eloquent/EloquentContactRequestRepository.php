<?php

namespace Modules\Contact\Repositories\Eloquent;

use Modules\Contact\Events\ContactRequestWasCreated;
use Modules\Contact\Repositories\ContactRequestRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Contact\Entities\ContactRequest;
//use App\Models\Contact;

class EloquentContactRequestRepository extends EloquentBaseRepository implements ContactRequestRepository
{
    public function create($data)
    {
        $contactRequest = $this->model->create($data);
       //contact::create($data);

        event(new ContactRequestWasCreated($contactRequest));

        return $contactRequest;
    }

}
