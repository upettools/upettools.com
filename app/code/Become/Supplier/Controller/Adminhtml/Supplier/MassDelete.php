<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

class MassDelete extends \Become\Supplier\Controller\Adminhtml\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $shopwholesale = $this->getRequest()->getParam('supplier');
        if (!is_array($shopwholesale) || empty($shopwholesale)) {
            $this->messageManager->addError(__('Please select Supplier(s).'));
        } else {
            $collection = $this->_shopbrandCollectionFactory->create()
                ->addFieldToFilter('shop_supplier_id', ['in' => $shopwholesale]);
            try {
                foreach ($collection as $item) {
                    $item->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($shopwholesale))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
