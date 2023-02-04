<?php

namespace Modules\Testimonials\Entities;

/**
 * Class Category
 * @package Modules\Testimonials\Entities
 */
class Category
{
    const UNCATEGORIZED = 0;
    const SOCIAL = 1;
    const DIGITAL = 2;
    const SEO = 3;
    const ECOMMERCE = 4;

    /**
     * @var array
     */
    private $categories = [];

    public function __construct()
    {
        $this->categories = [
            self::UNCATEGORIZED => trans('testimonials::category.uncategorized'),
            self::SOCIAL => trans('testimonials::category.social'),
            self::DIGITAL => trans('testimonials::category.digital'),
            self::SEO => trans('testimonials::category.seo'),
            self::ECOMMERCE => trans('testimonials::category.ecommarce'),
        ];
    }

    /**
     * Get the available categories
     * @return array
     */
    public function lists()
    {
        return $this->categories;
    }

    /**
     * Get the post category
     * @param int $categoryId
     * @return string
     */
    public function get($categoryId)
    {
        if (isset($this->$categories[$categoryId])) {
            return $this->$categories[$categoryId];
        }

        return $this->$categories[self::DRAFT];
    }
}
