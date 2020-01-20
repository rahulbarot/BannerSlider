<?php

namespace Awesome\BannerSlider\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;  
use \Magento\Framework\Filesystem;
use Awesome\BannerSlider\Model\BannersliderFactory;

class Banners extends Template
{
	protected $_bannersliderFactory;

	protected $_storeManager;

	protected $_filterProvider;	

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        BannersliderFactory $bannersliderFactory
    ) 
    {
    	$this->_storeManager = $storeManager;
    	$this->_bannersliderFactory = $bannersliderFactory;
    	$this->_filterProvider = $filterProvider;
        parent::__construct($context);
    }

    public function getBanners()
    {
        $bannerCollection = $this->_bannersliderFactory->create()->getCollection();
        $bannerCollection->addFieldToFilter('status',['eq' => 1]);
        $bannerCollection->setOrder('sort_order','ASC');
        return $bannerCollection;
    }

    public function getStoreData()
    {
    	return $this->_storeManager->getStore();
    }

    public function getFilteredContent($content)
    {
    	return $this->_filterProvider->getBlockFilter()->filter($content);
    }
}
