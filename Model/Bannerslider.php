<?php
namespace Awesome\BannerSlider\Model;

class Bannerslider extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Awesome\BannerSlider\Model\ResourceModel\Bannerslider');
    }
}
?>