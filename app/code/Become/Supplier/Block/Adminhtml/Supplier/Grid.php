<?php

namespace Become\Supplier\Block\Adminhtml\Supplier;

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
        \Become\Supplier\Model\ResourceModel\Shopsupplier\CollectionFactory $shopbrandCollectionFactory,

        array $data = []
    ) {
        $this->_shopbrandCollectionFactory = $shopbrandCollectionFactory;

        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('shopsupplierGrid');
        $this->setDefaultSort('shop_supplier_id');
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
            'telephone',
            [
                'header' => __('Telephone'),
                'type' => 'text',
                'index' => 'telephone',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
		$this->addColumn(
            'company',
            [
                'header' => __('Company'),
                'type' => 'text',
                'index' => 'company',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		

		
		$this->addColumn(
            'address',
            [
                'header' => __('Address'),
                'type' => 'text',
                'index' => 'address',
                'header_css_class' => 'col-name',
                'column_css_class' => 'col-name',
            ]
        );
		
		$this->addColumn(
            'categories',
            [
                'header' => __('Categories'),
                'type' => 'text',
                'index' => 'categories',
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
				'renderer'  => 'Become\Supplier\Block\Adminhtml\Helper\Renderer\Grid\Url',
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
        $this->getMassactionBlock()->setFormFieldName('supplier');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('supplier/*/massDelete'),
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
