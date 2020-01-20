<?php 

namespace Awesome\BannerSlider\Model\Source;

class TrueFalse implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {

        return  [
                    [
                        'value' => "true", 
                        'label' => __("Yes")
                    ], 
                    [
                        'value' => "false", 
                        'label' => __("No")
                    ],
                ];
    }

}