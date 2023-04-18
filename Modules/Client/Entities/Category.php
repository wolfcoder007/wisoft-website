<?php

namespace Modules\Client\Entities;

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
            self::UNCATEGORIZED => trans('client::category.uncategorized'),
            self::SOCIAL => trans('client::category.social'),
            self::DIGITAL => trans('client::category.digital'),
            self::SEO => trans('client::category.seo'),
            self::ECOMMERCE => trans('client::category.ecommarce'),
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
        if (isset($this->categories[$categoryId])) {
            return $this->categories[$categoryId];
        }

        return $this->categories[self::UNCATEGORIZED];
    }
}
