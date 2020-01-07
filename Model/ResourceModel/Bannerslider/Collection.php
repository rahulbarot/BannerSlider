<?php

namespace Awesome\BannerSlider\Model\ResourceModel\Bannerslider;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Awesome\BannerSlider\Model\Bannerslider', 'Awesome\BannerSlider\Model\ResourceModel\Bannerslider');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>