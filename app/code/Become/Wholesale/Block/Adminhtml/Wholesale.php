<?php

namespace Become\Wholesale\Block\Adminhtml;

class Wholesale extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor.
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_wholesale';
        $this->_blockGroup = 'Become_Wholesale';
        $this->_headerText = __('Wholesale');
        parent::_construct();
		$this->buttonList->remove('add');
    }
}
