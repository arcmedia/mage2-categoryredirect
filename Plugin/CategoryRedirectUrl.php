<?php
/**
 * Created by PhpStorm.
 * User: felix.elsener
 * Date: 21.02.2018
 * Time: 15:42
 */

namespace Arcmedia\CategoryRedirect\Plugin;

use Closure;
use Magento\Catalog\Helper\Category ;
use Magento\Catalog\Model\Category as ModelCategory;
use Magento\Catalog\Model\CategoryFactory;
use Arcmedia\CategoryRedirect\Helper\Data as HelperData;

class CategoryRedirectUrl
{
    /**
     * Category factory
     *
     * @var CategoryFactory
     */
    protected $categoryFactory;

    /**
     * Helper
     *
     * @var HelperData
     */
    protected $helper;

    /**
     * Constructor
     *
     * @param CategoryFactory $categoryFactory
     * @param HelperData $helper
     */
    public function __construct(
        CategoryFactory $categoryFactory,
        HelperData $helper
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->helper = $helper;
    }

    /**
     * Overwrite category URL if redirect is configured
     *
     * @see \Magento\Catalog\Helper\Category::getCategoryUrl
     *
     * @param \Magento\Catalog\Helper\Category $subject
     * @param \Closure $proceed
     * @param $category
     * @return string
     */
    public function aroundGetCategoryUrl
    (
        Category $subject,
        Closure $proceed,
        $category
    ) {
        if ($category->getUseRedirectUrl()) {
            if ($category instanceof ModelCategory) {
                $redirect = $category->getRedirectUrl();
            } else {
                $category = $this->categoryFactory->create()->setData($category->getData());
                $redirect = $category->getRedirectUrl();
            }

            if ($redirect) {
                return $this->helper->buildUrl($redirect);
            }
        }

        return $proceed($category);
    }
}