<?php

namespace Training\Seller\Block;


use Magento\Framework\View\Element\Context;
use Magento\Framework\Registry;
use Training\Seller\Helper\Url;

class AbstractBlock extends \Magento\Framework\View\Element\Template
{

    /**
     * @var Url
     */
    protected $helperUrl;

    /**
     * @var Registry
     */
    protected $registry;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, array $data, Url $url, Registry $registry)
    {
        parent::__construct($context, $data);
        $this->helperUrl = $url;
        $this->registry = $registry;
    }

    /**
     * @return string
     */
    public function getSellersUrl()
    {
        return $this->helperUrl->getSellersUrl();
    }

    /**
     * @param string $identifier
     * @return string
     */
    public function getSellerUrl($identifier)
    {
        return $this->helperUrl->getSellerUrl($identifier);
    }

}