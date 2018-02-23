<?php
/**
 * Created by PhpStorm.
 * User: felix.elsener
 * Date: 21.02.2018
 * Time: 17:28
 */

namespace Arcmedia\CategoryRedirect\Helper;

use Magento\Framework\UrlInterface;

class Data
{
    /**
     * Url Builder
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Build final URL from redirect entry
     *
     * @param $redirectUrl
     */
    public function buildUrl($redirectUrl)
    {
        if (is_string($redirectUrl)) {
            if (preg_match('#{{store url="(.*)"}}.*#', $redirectUrl, $matches)) {
                // Internal Link
                $redirectUrl = $this->urlBuilder->getUrl('', array('_direct' => $matches[1]));
            } else if (preg_match('#^https?://(.*)#', $redirectUrl, $matches)) {
                // External Link
                $redirectUrl = $matches[0];
            } else {
                // Homepage
                $redirectUrl = $this->urlBuilder->getUrl('', array('_direct' => ''));
            }

            return $redirectUrl;
        }

        return null;
    }

    public function isCurrent($redirectUrl)
    {
        return $this->buildUrl($redirectUrl) == $this->urlBuilder->getCurrentUrl();
    }
}