<?php
namespace Awesome\BannerSlider\Controller\Adminhtml\Manage;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Awesome\BannerSlider\Model\Bannerslider');

            $id = $this->getRequest()->getParam('banner_id');
            if ($id) {
                $model->load($id);
                $model->setCreatedAt(date('Y-m-d H:i:s'));
            }
			try{
				$uploader = $this->_objectManager->create(
					'Magento\MediaStorage\Model\File\Uploader',
					['fileId' => 'image']
				);
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
				/** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
				$imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(false);
				/** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
					->getDirectoryRead(DirectoryList::MEDIA);
				$result = $uploader->save($mediaDirectory->getAbsolutePath('emizen_banner'));
					if($result['error']==0)
					{
						$data['image'] = 'emizen_banner/' . $result['file'];
					} else {
						if(isset($data['image']['delete']) && $data['image']['delete'] == '1') {
							$data['image'] = '';
						} else {
							unset($data['image']);
						}
					}
			} catch (\Exception $e) {
				if(isset($data['image']['delete']) && $data['image']['delete'] == '1') {
					$data['image'] = '';
				} else {
					unset($data['image']);
				}
            }
			
			if(isset($data['image']['delete']) && $data['image']['delete'] == '1') {
				$data['image'] = '';
			} 

            try{
                $uploaderMob = $this->_objectManager->create(
                    'Magento\MediaStorage\Model\File\Uploader',
                    ['fileId' => 'mobile_image']
                );
                $uploaderMob->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                $uploaderMob->setAllowRenameFiles(true);
                $uploaderMob->setFilesDispersion(false);
                /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                    ->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploaderMob->save($mediaDirectory->getAbsolutePath('mobile_banner'));
                    if($result['error']==0)
                    {
                        $data['mobile_image'] = 'mobile_banner/' . $result['file'];
                    } else {
                        if(isset($data['mobile_image']['delete']) && $data['mobile_image']['delete'] == '1') {
                            $data['mobile_image'] = '';
                        } else {
                            unset($data['mobile_image']);
                        }
                    }
            } catch (\Exception $e) {
                if(isset($data['mobile_image']['delete']) && $data['mobile_image']['delete'] == '1') {
                    $data['mobile_image'] = '';
                } else {
                    unset($data['mobile_image']);
                }
            }
            
            if(isset($data['mobile_image']['delete']) && $data['mobile_image']['delete'] == '1') {
                $data['mobile_image'] = '';
            } 
			$data['store_ids'] = implode(',', $this->getRequest()->getParam('store_ids'));
          	$model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Bannerslider has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banner_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Bannerslider.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['banner_id' => $this->getRequest()->getParam('banner_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}