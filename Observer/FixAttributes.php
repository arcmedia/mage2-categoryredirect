<?php
/**
 * Created by PhpStorm.
 * User: felix.elsener
 * Date: 21.02.2018
 * Time: 15:55
 */

namespace Arcmedia\CategoryRedirect\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FixAttributes implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(
        Observer $observer
    ) {
        /**
         * @var $collection Collection
         */
        $collection = $observer->getEvent()->getCategoryCollection();
        $collection->addAttributeToSelect(['use_redirect_url', 'redirect_url']);
    }
}