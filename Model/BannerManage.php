<?php
namespace Awesome\BannerSlider\Model;
use Awesome\BannerSlider\Api\BannerManagement;
use Awesome\BannerSlider\Model\BannersliderFactory;
class BannerManage implements BannerManagement
{
    protected $_bannersliderFactory;

    public function __construct(
        BannersliderFactory $bannersliderFactory
    ) {
        $this->_bannersliderFactory = $bannersliderFactory;
    }
    
    public function getBanners()
    {
        $bannerCollection = $this->_bannersliderFactory->create()->getCollection();
        return $bannerCollection->getData();
    }

    public function deleteBanner($banner_id)
    {
        $banner = $this->_bannersliderFactory->create()->load($bannerId);
        // print_r($banner->getData());exit;
        return $banner->getData();
    }
}