<?php

namespace Modules\Industry\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Industry\Entities\Status;

class IndustryPresenter extends Presenter
{
    /**
     * @var \Modules\Industry\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Industry\Repositories\PostRepository
     */
    private $post;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->post = app('Modules\Industry\Repositories\IndustryRepository');
        $this->status = app('Modules\Industry\Entities\Status');
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
