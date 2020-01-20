<?php
namespace Awesome\BannerSlider\Block\Adminhtml;

class Bannerslider extends \Magento\Backend\Block\Widget\Grid\Container
{

	protected function _construct()
	{
		$this->_controller = 'adminhtml_bannerslider';
		$this->_blockGroup = 'Awesome_BannerSlider';
		$this->_headerText = __('Banners');
		$this->_addButtonLabel = __('Add New Banner');
		parent::_construct();
	}
}
