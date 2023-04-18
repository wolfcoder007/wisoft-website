<?php

namespace Modules\Client\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Client\Entities\Status;

class ClientPresenter extends Presenter
{
    /**
     * @var \Modules\Client\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Client\Repositories\PostRepository
     */
    private $post;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->post = app('Modules\Client\Repositories\ClientRepository');
        $this->status = app('Modules\Client\Entities\Status');
    }

    /**
     * Get the previous post of the current post
     * @return object
     */
    public function previous()
    {
        return $this->post->getPreviousOf($this->entity);
    }

    /**
     * Get the next post of the current post
     * @return object
     */
    public function next()
    {
        return $this->post->getNextOf($this->entity);
    }

    /**
     * Get the post status
     * @return string
     */
    public function status()
    {
        return $this->status->get($this->entity->status);
    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::DRAFT:
                return 'bg-red';
                break;
            case Status::PENDING:
                return 'bg-orange';
                break;
            case Status::PUBLISHED:
                return 'bg-green';
                break;
            case Status::UNPUBLISHED:
                return 'bg-purple';
                break;
            default:
                return 'bg-red';
                break;
        }
    }
}
