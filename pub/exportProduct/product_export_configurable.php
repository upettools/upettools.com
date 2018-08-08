<?php
require 'config.php';

error_reporting(E_ALL | E_STRICT);
header("Content-Type: text/html;charset=utf-8");
 
//$collection->setPageSize(3); // selecting only 3 products

    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
	$storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
    $repository = $objectManager->create('Magento\Catalog\Model\ProductRepository');	
    $store_id = 1;

$fp = fopen('configurable-'.date("Y-m-d").'.csv', 'w');
$csvHeader = array("Name","Sku","attribute Options","TypeId","Price","Url","Image");
fputcsv( $fp, $csvHeader,",");
//$collection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory')->create()->addStoreFilter($store_id)->addAttributeToFilter('type_id', 'configurable')->addAttributeToSelect(array('name','sku'));
$collection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory')->create()->addStoreFilter($store_id)->addAttributeToFilter('type_id', 'configurable')->addAttributeToSelect('*');
foreach ($collection as $product)
{
	//var_dump($product->getData());
	$productAttributeOptions = $product->getTypeInstance(true)->getConfigurableAttributesAsArray($product);
	$attributeOptions = array();
				foreach ($productAttributeOptions as $productAttribute) {
					foreach ($productAttribute['values'] as $attribute) {
						$attributeOptions[$productAttribute['label']][$attribute['value_index']] = $attribute['store_label'];
					}
				}
    $TypeId = $product->getTypeId();
    $name = $product->getName();
    $sku = $product->getSku();
	$price_us = $product->getFinalPrice();
	$goods_img = $storeManager->getStore()->getBaseUrl().'media/catalog/product'.$product->getSmallImage();
	$goods_url= $storeManager->getStore()->getBaseUrl().$product->getUrlKey().'.html';
    fputcsv($fp, array($name,iconv("utf-8","gbk//IGNORE",$sku),stripslashes(json_encode($attributeOptions,true)),$TypeId,$price_us,$goods_url,$goods_img), ",");

    $child_products = $product->getTypeInstance()->getUsedProducts($product, null);
    if(count($child_products) > 0)
    {
        foreach($child_products as $child)
        {
			$attributeOptions=array();
            $TypeId = $child->getTypeId();
			$name = $child->getName();
			$sku = $child->getSku();
			$price_us = $child->getFinalPrice();
			$goods_img = $child->getStore()->getBaseUrl().'media/catalog/product'.$child->getSmallImage();
			$goods_url= $child->getStore()->getBaseUrl().$child->getUrlKey().'.html';
			fputcsv($fp, array($name,iconv("utf-8","gbk//IGNORE",$sku),stripslashes(json_encode($attributeOptions,true)),$TypeId,$price_us,$goods_url,$goods_img), ",");
        }
    }   
}
fclose($fp);