<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

class Edit extends \Become\Supplier\Controller\Adminhtml\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('shop_supplier_id');
        $storeViewId = $this->getRequest()->getParam('store');
        $model = $this->_shopbrandFactory->create();

        if ($id) {
            $model->setStoreViewId($storeViewId)->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Supplier no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('shopsupplier', $model);

        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}
