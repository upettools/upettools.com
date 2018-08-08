<?php
require 'config.php';

error_reporting(E_ALL | E_STRICT);
header("Content-Type: text/html;charset=utf-8");
$productCollectionFactory = $obj->get('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
$collection = $productCollectionFactory->create();
$collection->addAttributeToSelect('*');
$collection->addAttributeToFilter('status', array('eq' => 1)); 
$collection->addAttributeToFilter('status', ['in' => $obj->get('\Magento\Catalog\Model\Product\Attribute\Source\Status')->getVisibleStatusIds()]);
$collection->setVisibility($obj->get('\Magento\Catalog\Model\Product\Visibility')->getVisibleInSiteIds());
$collection->addFilter('type_id','simple');//simple
 
//$collection->setPageSize(3); // selecting only 3 products

    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
	$storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');			

	$fp = fopen('simple-'.date("Y-m-d").'.csv', 'w');
	$csvHeader = array("Name","Sku","attribute Options","TypeId","Price","Url","Image");
	fputcsv( $fp, $csvHeader,",");

			foreach ($collection as $product){
					//print_r($product->getData());exit;
					$attributeOptions=array();
					$sku = trim($product->getSku());
					$name = trim($product->getName());
					$TypeId = trim($product->getTypeId());
					//$weight = $product->getWeight();
					//$goods_img = 'https://res-1.cloudinary.com/aswanu/image/upload/c_pad,dpr_1.0,f_auto,h_600,q_80,w_600/media/catalog/product'.$product->getImage();
					$goods_img = $storeManager->getStore()->getBaseUrl().'media/catalog/product'.$product->getSmallImage();
					$goods_url = $storeManager->getStore()->getBaseUrl().$product->getUrlKey().'.html';
					$price_us = $product->getFinalPrice();
					
					$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
					$repository = $objectManager->create('Magento\Catalog\Model\ProductRepository');
					//$product = $repository->getById($product->getId());

					 fputcsv($fp, array($name,iconv("utf-8","gbk//IGNORE",$sku),stripslashes(json_encode($attributeOptions,true)),$TypeId,$price_us,$goods_url,$goods_img), ",");
					  //echo ' : '.$pr->getPrice()."\n";
			
					
				}

    fclose($fp);
