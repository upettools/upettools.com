<?php

namespace Become\Supplier\Block\Adminhtml;

class Supplier extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor.
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_supplier';
        $this->_blockGroup = 'Become_Supplier';
        $this->_headerText = __('Supplier');
        //$this->_addButtonLabel = __('Add New Wholesale');
        parent::_construct();
		$this->buttonList->remove('add');
    }
}
