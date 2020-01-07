<?php

namespace Awesome\BannerSlider\Controller\Adminhtml\Manage;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		// $resultPage->setActiveMenu('Awesome_BannerSlider::aws_bannerslider');
  //       $resultPage->addBreadcrumb(__('Drc'), __('Drc'));
  //       $resultPage->addBreadcrumb(__('Manage item'), __('Manage Bannerslider'));
		$resultPage->getConfig()->getTitle()->prepend((__('Manage Banners')));
		return $resultPage;
	}


}
