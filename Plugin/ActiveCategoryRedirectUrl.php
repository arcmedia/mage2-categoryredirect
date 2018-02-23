<?php
/**
 * Created by PhpStorm.
 * User: felix.elsener
 * Date: 21.02.2018
 * Time: 15:42
 */

namespace Arcmedia\CategoryRedirect\Plugin;

use Closure;
use Magento\Catalog\Observer\MenuCategoryData;
use Arcmedia\CategoryRedirect\Helper\Data as HelperData;

class ActiveCategoryRedirectUrl
{
    /**
     * Helper
     *
     * @var HelperData
     */
    protected $helper;

    /**
     * Constructor
     *
     * @param $helper
     */
    public function __construct
    (
        HelperData $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Overwrite category active state if redirect is configured
     *
     * @see \Magento\Catalog\Observer\MenuCategoryData::getMenuCategoryData
     *
     * @param \Magento\Catalog\Helper\Category $subject
     * @param \Closure $proceed
     * @param $category
     * @return string
     */
    public function aroundGetMenuCategoryData
    (
        MenuCategoryData $subject,
        Closure $proceed,
        $category
    ) {
        $result = $proceed($category);

        if ($category->getRedirectUrl() && $redirectUrl = $category->getRedirectUrl()) {
            $result['is_active'] = $this->helper->isCurrent($redirectUrl);
        }

        return $result;
    }
}