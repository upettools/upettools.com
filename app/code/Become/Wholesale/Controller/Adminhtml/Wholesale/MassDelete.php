<?php

namespace Become\Wholesale\Controller\Adminhtml\Wholesale;

class MassDelete extends \Become\Wholesale\Controller\Adminhtml\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $shopwholesale = $this->getRequest()->getParam('wholesale');
        if (!is_array($shopwholesale) || empty($shopwholesale)) {
            $this->messageManager->addError(__('Please select shopwholesale(s).'));
        } else {
            $collection = $this->_shopbrandCollectionFactory->create()
                ->addFieldToFilter('shop_wholesale_id', ['in' => $shopwholesale]);
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
