<?php

namespace Awesome\BannerSlider\Block\Adminhtml\Bannerslider\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Store\Model\System\Store;

class Info extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;
    
    protected $_systemStore;

   /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $newsStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Store  $systemStore,
        array $data = []
    ) {
         $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
       /** @var $model \Tutorial\SimpleNews\Model\News */
        $model = $this->_coreRegistry->registry('bannerslider');
        // echo "<pre>";
        // print_r($model->getData());exit;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('banner_');
        // $form->setFieldNameSuffix('banner');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'banner_id',
                'hidden',
                ['name' => 'banner_id']
            );
        }

        $fieldset->addField(
            'status',
            'checkbox',
            [
                'label' => __('Status'), 
                'required' => false, 
                'name' => 'status',
                'onchange' => 'this.value = (Number(this.checked));',
                'class' => 'admin__actions-switch-checkbox', 
                'after_element_js' => '
                    <label class="admin__actions-switch-label" for="status">
                        <span class="admin__actions-switch-text" data-text-on="'.__('Enabled').'" data-text-off="'.__('Disabled').'"></span>
                    </label>
                '
            ]
        );

        if($model->getStatus()){
            $isEnabled = $model->getStatus();
            $form->getElement('status')->setIsChecked($isEnabled);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name'        => 'title',
                'label'    => __('Title'),
                'required'     => true
            ]
        );

        $fieldset->addField(
            'sub_title',
            'text',
            [
                'name'        => 'sub_title',
                'label'    => __('Sub Title')
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'description',
            'editor',
            [
                'name'        => 'description',
                'label'    => __('Description'),
                'config'    => $wysiwygConfig
            ]
        );

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Banner Image'),
                'title' => __('Banner Image'),
                'required' => true
            ]
        );
        $fieldset->addField(
            'mobile_image',
            'image',
            [
                'name' => 'mobile_image',
                'label' => __('Banner Image for Mobile'),
                'title' => __('Banner Image for Mobile'),
                'note'=> 'Please upload `1242 X 540` resolution image.',
                'required' => true
            ]
        );

        $fieldset->addField(
            'url',
            'text',
            [
                'name'        => 'url',
                'label'    => __('Url')
            ]
        );

        $fieldset->addField(
            'store_ids',
            'multiselect',
            [
                'name'     => 'store_ids[]',
                'label'    => __('Store Views'),
                'title'    => __('Store Views'),
                'required' => true,
                'values'   => $this->_systemStore->getStoreValuesForForm(false, true),
            ]
        );

        $fieldset->addField(
            'sort_order',
            'text',
            [
                'name'        => 'sort_order',
                'label'    => __('Sort Order'),
                'required'     => true
            ]
        );

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('News Info');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('News Info');
    }
 
    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }
 
    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}