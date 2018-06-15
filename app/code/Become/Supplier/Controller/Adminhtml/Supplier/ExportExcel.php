<?php

namespace Become\Supplier\Controller\Adminhtml\Supplier;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportExcel extends \Become\Supplier\Controller\Adminhtml\Action
{
    public function execute()
    {
        $fileName = date('Y-m-d-h-i-s').'-supplier.xls';

        /** @var \\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Become\Supplier\Block\Adminhtml\Supplier\Grid')->getExcel();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
