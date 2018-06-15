<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

class Delete extends \Become\Supplier\Controller\Adminhtml\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('shop_supplier_id');
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
