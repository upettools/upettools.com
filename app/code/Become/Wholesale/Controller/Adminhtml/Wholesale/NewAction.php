<?php

namespace Become\Wholesale\Controller\Adminhtml\Wholesale;

class NewAction extends \Become\Wholesale\Controller\Adminhtml\Action
{
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
