<?php

namespace Modules\Testimonials\Entities;

/**
 * Class Status
 * @package Modules\Blog\Entities
 */
class Status
{
    const DRAFT = 0;
    const PENDING = 1;
    const PUBLISHED = 2;
    const UNPUBLISHED = 3;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DRAFT => trans('testimonials::status.draft'),
            self::PENDING => trans('testimonials::status.pending review'),
            self::PUBLISHED => trans('testimonials::status.published'),
            self::UNPUBLISHED => trans('testimonials::status.unpublished'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::DRAFT];
    }
}
