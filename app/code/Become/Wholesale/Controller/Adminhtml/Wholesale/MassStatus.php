<?php

namespace Become\Wholesale\Controller\Adminhtml\Wholesale;

class MassStatus extends \Become\Wholesale\Controller\Adminhtml\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $shopbrandIds = $this->getRequest()->getParam('wholesale');
        $additionalcategory = $this->getRequest()->getParam('additionalcategory');
        $storeViewId = $this->getRequest()->getParam('store');
        if (!is_array($shopbrandIds) || empty($shopbrandIds)) {
            $this->messageManager->addError(__('Please select wholesale(s).'));
        } else {
            $collection = $this->_shopbrandCollectionFactory->create()
                // ->setStoreViewId($storeViewId)
                ->addFieldToFilter('shop_wholesale_id', ['in' => $shopbrandIds]);
            try {
                foreach ($collection as $item) {
                    $item->setStoreViewId($storeViewId)
                        ->setAdditionalcategory($additionalcategory)
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
