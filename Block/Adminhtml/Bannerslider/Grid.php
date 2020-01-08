<?php

namespace Awesome\BannerSlider\Block\Adminhtml\Bannerslider;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{

	protected $_bannerSlider;

	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Backend\Helper\Data $backendHelper,
		\Awesome\BannerSlider\Model\BannersliderFactory $bannerSlider,
		array $data = []
	)
	{
		$this->_bannerSlider = $bannerSlider;
		parent::__construct($context, $backendHelper, $data);
	}

	/**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_bannerSlider->create()->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
		        $this->addColumn(
		            'banner_id',
		            [
		                'header' => __('ID'),
		                'type' => 'number',
		                'index' => 'banner_id',
		                'header_css_class' => 'col-id',
		                'column_css_class' => 'col-id'
		            ]
		        );

				$this->addColumn(
					'title',
					[
						'header' => __('Banner Title'),
						'index' => 'title',
					]
				);
				
				$this->addColumn(
					'sub_title',
					[
						'header' => __('Banner Sub Title'),
						'index' => 'sub_title',
					]
				);
				
				$this->addColumn(
					'url',
					[
						'header' => __('Banner Url'),
						'index' => 'url',
					]
				);
				
				$this->addColumn(
					'sort_order',
					[
						'header' => __('Sort Order'),
						'index' => 'sort_order',
					]
				);

				$this->addColumn(
					'created_at',
					[
						'header' => __('Created at'),
						'index' => 'created_at',
					]
				);
		
		   $this->addExportType($this->getUrl('bannerslider/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('bannerslider/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldName('bannerslider');
        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('bannerslider/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('bannerslider/*/index', ['_current' => true]);
    }

    /**
     * @param \Drc\Bannerslider\Model\bannerslider|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'bannerslider/*/edit',
            ['banner_id' => $row->getId()]
        );
		
    }
}