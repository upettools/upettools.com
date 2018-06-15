<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportCsv extends \Become\Supplier\Controller\Adminhtml\Action
{
    public function execute()
    {
        $fileName = date('Y-m-d-h-i-s').'-supplier.csv';

        /** @var \\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Become\Supplier\Block\Adminhtml\Supplier\Grid')->getCsv();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
