<?php

namespace Become\Wholesale\Controller\Adminhtml\Wholesale;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportExcel extends \Become\Wholesale\Controller\Adminhtml\Action
{
    public function execute()
    {
        $fileName = date('Y-m-d-h-i-s').'-wholesale.xls';

        /** @var \\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Become\Wholesale\Block\Adminhtml\Wholesale\Grid')->getExcel();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
