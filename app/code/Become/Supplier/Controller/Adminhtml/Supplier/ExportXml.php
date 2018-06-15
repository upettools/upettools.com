<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportXml extends \Become\Supplier\Controller\Adminhtml\Action
{
    public function execute()
    {
        $fileName = 'supplier.xml';

        /** @var \\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Become\Supplier\Block\Adminhtml\Supplier\Grid')->getXml();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
