<?php

namespace Become\Wholesale\Block\Adminhtml\Wholesale;

use Become\Wholesale\Model\Organization;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * shopbrand collection factory.
     *
     * @var \Vicomage\Brand\Model\ResourceModel\Shopbrand\CollectionFactory
     */
    protected $_shopbrandCollectionFactory;


    /**
     * construct.
     *
     * @param \Magento\Backend\Block\Template\Context                         $context
     * @param \Magento\Backend\Helper\Data                                    $backendHelper
     * @param \Vicomage\Brand\Model\ResourceModel\Shopbrand\CollectionFactory $shopbrandCollectionFactory
     * @param array                                                           $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Become\Wholesale\Model\ResourceModel\Shopwholesale\CollectionFactory $shopbrandCollectionFactory,

        array $data = []
    ) {
        $this->_shopbrandCollectionFactory = $shopbrandCollectionFactory;

        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('shopwholesaleGrid');
        $this->setDefaultSort('shop_wholesale_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $store = $this->getRequest()->getParam('store');
        $collection = $this->_shopbrandCollectionFactory->create();
       //$collection->addFieldToFilter('stores',array( array('finset' => 0), array('finset' => $store)));
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {

        $this->addColumn(
            'personal_name',
            [
                'header' => __('Name'),
                'type' => 'text',
                'index' => 'personal_name',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );

        $this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'type' => 'text',
                'index' => 'email',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
	    $this->addColumn(
            'phone_number',
            [
                'header' => __('Phone'),
                'type' => 'text',
                'index' => 'phone_number',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
		// $this->addColumn(
            // 'additionalcategory',
            // [
                // 'header' => __('Additional Category'),
                // 'type' => 'text',
                // 'index' => 'additionalcategory',
                // 'header_css_class' => 'col-name',
                // 'column_css_class' => 'col-name',
            // ]
        // );
		
		// $this->addColumn(
            // 'additionalcategory',
            // [
                // 'header' => __('Additional Category'),
                // 'type' => 'text',
                // 'index' => 'additionalcategory',
                // 'header_css_class' => 'col-name',
                // 'column_css_class' => 'col-name',
            // ]
        // );
		
		$this->addColumn(
            'additionalcategory',
            [
                'header' => __('Organization'),
                'index' => 'additionalcategory',
                'type' => 'options',
                'options' => Organization::getAvailableCategory(),
            ]
        );
		
		$this->addColumn(
            'additionalname',
            [
                'header' => __('Additional Name'),
                'type' => 'text',
                'index' => 'additionalname',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
		$this->addColumn(
            'files_name_url',
            [
                'header' => __('Files Url'),
                'type' => 'text',
                'index' => 'files_name_url',
				'renderer'  => 'Become\Wholesale\Block\Adminhtml\Helper\Renderer\Grid\Url',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
				
            ]
        );
		
		$this->addColumn(
            'interested_categories',
            [
                'header' => __('Interested categories'),
                'type' => 'text',
                'index' => 'interested_categories',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
		$this->addColumn(
            'sales_area',
            [
                'header' => __('Sales to where'),
                'type' => 'text',
                'index' => 'sales_area',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
		$this->addColumn(
            'sales_amount',
            [
                'header' => __('Sales target amount'),
                'type' => 'text',
                'index' => 'sales_amount',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
		$this->addColumn(
            'created_at',
            [
                'header' => __('Created At'),
                'type' => 'datetime',
                'index' => 'created_at',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );

        // $this->addColumn(
            // 'image',
            // [
                // 'header' => __('Image'),
                // 'class' => 'xxx',
                // 'width' => '50px',
                // 'filter' => false,
                // 'renderer' => 'Become\Wholesale\Block\Adminhtml\Helper\Renderer\Grid\Image',
            // ]
        // );


      
        // $this->addColumn(
            // 'edit',
            // [
                // 'header' => __('Edit'),
                // 'type' => 'action',
                // 'getter' => 'getId',
                // 'actions' => [
                    // [
                        // 'caption' => __('Edit'),
                        // 'url' => ['base' => '*/*/edit'],
                        // 'field' => 'shop_wholesale_id',
                    // ],
                // ],
                // 'filter' => false,
                // 'sortable' => false,
                // 'index' => 'stores',
                // 'header_css_class' => 'col-action',
                // 'column_css_class' => 'col-action',
            // ]
        // );
        $this->addExportType('*/*/exportCsv', __('CSV'));
       // $this->addExportType('*/*/exportXml', __('XML'));
        $this->addExportType('*/*/exportExcel', __('Excel'));

        return parent::_prepareColumns();
    }

    /**
     * get brand vailable option
     *
     * @return array
     */

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('wholesale');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('wholesale/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );

        // $Organization = Organization::getAvailableCategory();

        // array_unshift($Organization, ['label' => '', 'value' => '']);
        // $this->getMassactionBlock()->addItem(
            // 'additionalcategory',
            // [
                // 'label' => __('Change Organization'),
                // 'url' => $this->getUrl('wholesale/*/massStatus', ['_current' => true]),
                // 'additional' => [
                    // 'visibility' => [
                        // 'name' => 'additionalcategory',
                        // 'type' => 'select',
                        // 'class' => 'required-entry',
                        // 'label' => __('Organization'),
                        // 'values' => $Organization,
                    // ],
                // ],
            // ]
        // );

        return $this;
    }

    // /**
     // * @return string
     // */
    // public function getGridUrl()
    // {
        // return $this->getUrl('*/*/grid', ['_current' => true]);
    // }

    /**
     * get row url
     * @param  object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        // return $this->getUrl(
            // '*/*/edit',
            // ['shop_wholesale_id' => $row->getId()]
        // );
    }
}
