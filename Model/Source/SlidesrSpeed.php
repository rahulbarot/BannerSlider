<?php 

namespace Awesome\BannerSlider\Model\Source;

class SlidesrSpeed implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {

        return  [
                    [
                        'value' => 100, 
                        'label' => __(100)
                    ], 
                    [
                        'value' => 200, 
                        'label' => __(200)
                    ],
                    [
                        'value' => 300, 
                        'label' => __(300)
                    ],
                    [
                        'value' => 400, 
                        'label' => __(400)
                    ],
                ];
    }

}