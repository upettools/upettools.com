<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

class NewAction extends \Become\Supplier\Controller\Adminhtml\Action
{
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
