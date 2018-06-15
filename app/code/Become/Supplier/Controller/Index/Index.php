<?php
 
namespace Become\Supplier\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
	
	protected $_objectManager;
	
	 /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;
	
	protected $_transportBuilder;
	
	protected $_mediaDirectory;
	
    protected $_fileUploaderFactory;
	
    protected $_resultRedirectFactory;
 
    public function __construct(
	 Context $context, 
	 \Magento\Framework\View\Result\PageFactory $resultPageFactory,
	 \Magento\Framework\ObjectManagerInterface $objectManager,
	 \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
	 \Magento\Framework\Filesystem $filesystem,
     \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
	 \Magento\Framework\Controller\Result\Redirect $resultRedirectFactory,
	 \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
	)
    {
        $this->_resultPageFactory = $resultPageFactory;
		$this->_objectManager = $objectManager;
		$this->inlineTranslation = $inlineTranslation;
		$this->_transportBuilder = $transportBuilder;
		$this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }
 
    public function execute()
    {
		
        $resultPage = $this->_resultPageFactory->create();
        // return $resultPage;
		
		$post = $this->getRequest()->getPostValue();
		if($post){
			$name = [$post['firstname'], $post['lastname']];
		    $post['personal_name'] =  implode(',',$name);
		}
		
		//print_r($post);exit;
        if (!$post) {
           // $this->_redirect('wholesale/');
            return $resultPage;
        }
		
		try{
			if($post){
				
				$company = $post['company'];
				$target = $this->_mediaDirectory->getAbsolutePath('supplier/files/'.$company.'');        
				/** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
				$uploader = $this->_fileUploaderFactory->create(['fileId' => 'files_name_url']);
				/** Allowed extension types */
				$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'zip', 'doc','csv', 'xls','rar','xlsx','docx','txt','pdf']);
				/** rename file name if already exists */
				$uploader->setAllowRenameFiles(true);
				/** upload file in folder "mycustomfolder" */
				$result = $uploader->save($target);
				// $name = explode('.',$result['file']);
				// $newName = $post['email'].date('Ymdhis').'.'.$name[1];
				$post['files_name_url'] = 'supplier/files/'.$company.'/'.$result['file'];
			
			}
			
			// if ($result['file']) {
				// $this->messageManager->addSuccess(__('File has been successfully uploaded')); 
			// }
			
		  
		} catch (\Exception $e) {
			 $this->messageManager->addError($e->getMessage());
		}

	   
        //$this->inlineTranslation->suspend();
        try {
            //$postObject = new \Magento\Framework\DataObject();
            //$postObject->setData($post);

            // $error = false;

            // if (!\Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
                // $error = true;
            // }
            // if ($error) {
                // throw new \Exception();
            // }

            $storeViewId = $this->getRequest()->getParam('store');
		    $model = $this->_objectManager->create('Become\Supplier\Model\Shopsupplier');
		   //$model->setData($post);
		    $model->setData($post)->setStoreViewId($storeViewId);
            $model->save();
            // $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            // $transport = $this->_transportBuilder
                // ->setTemplateIdentifier($this->scopeConfig->getValue(self::XML_PATH_EMAIL_TEMPLATE, $storeScope))
                // ->setTemplateOptions(
                    // [
                        // 'area' => \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE,
                        // 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    // ]
                // )
                // ->setTemplateVars(['data' => $postObject])
                // ->setFrom($this->scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER, $storeScope))
                // ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
                // ->setReplyTo($post['email'])
                // ->getTransport();

            // $transport->sendMessage();
            // $this->inlineTranslation->resume();
            $this->messageManager->addSuccess(
                __('您已成功提交信息！')
            );
            $this->_redirect('supplier');
            return;
        } catch (\Exception $e) {
            //$this->inlineTranslation->resume();
            $this->messageManager->addError(
                __('信息提交失败!')
            );
            $this->_redirect('supplier');
            return;
        }
    }
}