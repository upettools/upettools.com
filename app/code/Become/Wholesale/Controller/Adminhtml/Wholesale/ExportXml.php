<?php

namespace Become\Wholesale\Controller\Adminhtml\Wholesale;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportXml extends \Become\Wholesale\Controller\Adminhtml\Action
{
    public function execute()
    {
        $fileName = 'Wholesale.xml';

        /** @var \\Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Become\Wholesale\Block\Adminhtml\Wholesale\Grid')->getXml();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
