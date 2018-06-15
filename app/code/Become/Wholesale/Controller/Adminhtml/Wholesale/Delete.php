<?php

namespace Become\Wholesale\Controller\Adminhtml\Wholesale;

class Delete extends \Become\Wholesale\Controller\Adminhtml\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('shop_wholesale_id');
        try {
            $item = $this->_shopbrandFactory->create()->setId($id);
            $item->delete();
            $this->messageManager->addSuccess(
                __('Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
