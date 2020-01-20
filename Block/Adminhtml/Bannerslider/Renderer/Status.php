<?php
 
namespace Awesome\BannerSlider\Block\Adminhtml\Bannerslider\Renderer;
 
use Magento\Framework\DataObject;
 
class Status extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    public function render(DataObject $row)
    {
        $isEnabled = $row->getData($this->getColumn()->getIndex());
        return $isEnabled ? '<span style="padding: 5px 45px;color: green;">'.__('Enabled').'</span>' : '<span style="padding: 5px 42px;color: red;">'.__('Disabled').'</span>';
    }
}