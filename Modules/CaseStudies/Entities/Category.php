<?php

namespace Modules\CaseStudies\Entities;

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
            self::UNCATEGORIZED => trans('casestudies::category.uncategorized'),
            self::SOCIAL => trans('casestudies::category.social'),
            self::DIGITAL => trans('casestudies::category.digital'),
            self::SEO => trans('casestudies::category.seo'),
            self::ECOMMERCE => trans('casestudies::category.ecommarce'),
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
