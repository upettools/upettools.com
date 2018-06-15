<?php


namespace  Become\Wholesale\Block\Adminhtml\Wholesale\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * construct.
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('shopwholesale_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Wholesale Information'));
    }

}
