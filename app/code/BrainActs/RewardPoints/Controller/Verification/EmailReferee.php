<?php
/**
 * Copyright (c) 2017 BrainActs Commerce OÜ, All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace BrainActs\RewardPoints\Controller\Verification;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class EmailReferee
 *
 * @author BrainActs Core Team <support@brainacts.com>
 */
class EmailReferee extends \Magento\Framework\App\Action\Action
{


    private $storeManager;

	private $request;
	
	protected $resultJsonFactory;

    public function __construct(
       \Magento\Framework\App\Action\Context $context,
	   \Magento\Store\Model\StoreManagerInterface $storeManager,
	   \Magento\Framework\App\Request\Http $request,
	   \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
	   )
    {
		
       // return parent::__construct($context);
        parent::__construct($context);
		$this->storeManager = $storeManager;
		$this->request = $request;
		$this->resultJsonFactory = $resultJsonFactory;
    }
	
    /**
     * Display customer reward points history
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // /** @var \Magento\Framework\View\Result\Page resultPage */
       // $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        // return $resultPage;
		
		$emailReferee = $this->request->getParam('email_referee');
		$resultPage = $this->getPostReferee($emailReferee);
		
		$resultJson = $this->resultJsonFactory->create();
		
        return $resultJson->setData(['status' => $resultPage]);
    }
	
	public function getPostReferee($emailReferee){
		
		if (isset($emailReferee) || !empty($emailReferee)) {
			//$id = $this->getRequest()->getParam('id');
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
			$CustomerModel = $objectManager->create('Magento\Customer\Model\Customer');
			$CustomerModel->setWebsiteId($this->storeManager->getStore()->getId());// **//Here 1 means Store ID**
			$CustomerModel->loadByEmail($emailReferee);
			$userId = $CustomerModel->getId();
			if($userId>0){
				return 1;
			
			}else{
				return 0;
			}
		}
	}
}
