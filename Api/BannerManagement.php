<?php
namespace Awesome\BannerSlider\Api;
interface BannerManagement
{
    /**
     * @api
     * @return $collection
     */
    public function getBanners();


    /**
     * @api
     * @param int $banner_id
     * @return $collection
     */
    public function deleteBanner($banner_id);
}