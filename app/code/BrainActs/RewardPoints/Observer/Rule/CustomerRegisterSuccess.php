<?php
/**
 * Copyright (c) 2017 BrainActs Commerce OÜ, All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace BrainActs\RewardPoints\Observer\Rule;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class CustomerRegisterSuccess
 *
 * @author BrainActs Core Team <support@brainacts.com>
 */
class CustomerRegisterSuccess implements ObserverInterface
{

    /**
     * @var \BrainActs\RewardPoints\Model\HistoryFactory
     */
    private $historyFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $loger;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \BrainActs\RewardPoints\Helper\Data
     */
    private $helper;
	
	protected $request;

    /**
     * CustomerRegisterSuccess constructor.
     * @param \BrainActs\RewardPoints\Model\HistoryFactory $historyFactory
     * @param \Psr\Log\LoggerInterface $loger
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \BrainActs\RewardPoints\Helper\Data $helper
     */
    public function __construct(
        \BrainActs\RewardPoints\Model\HistoryFactory $historyFactory,
        \Psr\Log\LoggerInterface $loger,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \BrainActs\RewardPoints\Helper\Data $helper,
		\Magento\Framework\App\Request\Http $request
    ) {
        $this->historyFactory = $historyFactory;
        $this->loger = $loger;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
		$this->request = $request;
    }

    /**
     * @param Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getData('customer');
		
		$emailReferee = $this->request->getPost('email_referee');
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		$CustomerModel = $objectManager->create('Magento\Customer\Model\Customer');
		$CustomerModel->setWebsiteId($this->storeManager->getStore()->getId());// **//Here 1 means Store ID**
		$CustomerModel->loadByEmail($emailReferee);
        $userId = $CustomerModel->getId();
        
		if($userId>0){

       
		//print_r($userId);exit;

        // $name = [$customer->getFirstname(), $customer->getLastname()];
        $name = [$CustomerModel->getFirstname(), $CustomerModel->getLastname()];
        try {
           // $points = $this->helper->getRegistrationRulePoints();
            $points = $userId;
            if (empty($points)) {
                return $this;
            }
            /**
             * @var \BrainActs\RewardPoints\Model\History $model
             */
            $model = $this->historyFactory->create();
            $model->setCustomerId($userId);
            $model->setCustomerName($CustomerModel->getEmail());
            //$model->setCustomerName(implode(', ', $name));
            $model->setPoints(0);
            $model->setRuleName(__('Referee Registration'));
            $model->setStoreId($this->storeManager->getStore()->getId());
            $model->setTypeRule(3);
            $model->save();
			
			// $model = $this->historyFactory->create();
            // $model->setCustomerId($customer->getId());
            // $model->setCustomerName(implode(', ', $name));
            // $model->setPoints($points);
            // $model->setRuleName(__('Registration'));
            // $model->setStoreId($this->storeManager->getStore()->getId());
            // $model->setTypeRule(3);
            // $model->save();
        } catch (\Exception $e) {
            $this->loger->critical($e);
        }
    }
        return $this;
    }
}
