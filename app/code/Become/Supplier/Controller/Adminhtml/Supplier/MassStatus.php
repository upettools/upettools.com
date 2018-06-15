<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

class MassStatus extends \Become\Supplier\Controller\Adminhtml\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $shopbrandIds = $this->getRequest()->getParam('supplier');
        $categories = $this->getRequest()->getParam('categories');
        $storeViewId = $this->getRequest()->getParam('store');
        if (!is_array($shopbrandIds) || empty($shopbrandIds)) {
            $this->messageManager->addError(__('Please select Supplier(s).'));
        } else {
            $collection = $this->_shopbrandCollectionFactory->create()
                // ->setStoreViewId($storeViewId)
                ->addFieldToFilter('shop_supplier_id', ['in' => $shopbrandIds]);
            try {
                foreach ($collection as $item) {
                    $item->setStoreViewId($storeViewId)
                        ->setCategories($categories)
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been changed.', count($shopbrandIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/', ['store' => $this->getRequest()->getParam('store')]);
    }
}
