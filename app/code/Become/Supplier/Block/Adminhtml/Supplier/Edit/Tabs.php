<?php


namespace  Become\Supplier\Block\Adminhtml\Supplier\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * construct.
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('shopsupplier_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Supplier Information'));
    }

}
