<?php
use Magento\Framework\App\Bootstrap;
 
/**
 * If your external file is in root folder
 */
require  '../../app/bootstrap.php';

ini_set('display_errors', 1);
ini_set('memory_limit','512M');
 
/**
 * If your external file is NOT in root folder
 * Let's suppose, your file is inside a folder named 'xyz'
 *
 * And, let's suppose, your root directory path is
 * /var/www/html/magento2
 */
// $rootDirectoryPath = '/var/www/html/magento2';
// require $rootDirectoryPath . '/app/bootstrap.php';
 
$params = $_SERVER;
 
$bootstrap = Bootstrap::create(BP, $params);
 
$obj = $bootstrap->getObjectManager();
 
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
 

 
// foreach ($collection as $product) {
    // print_r($product->getSku());     
    // echo "<br>";
// }
 
// $quoteId = 1;
// $quote = $obj->get('Magento\Checkout\Model\Session')
             // ->getQuote()
             // ->load($quoteId);
 
// echo '<pre>';
// print_r($quote->getOrigData());
// echo '</pre>';
 
// $productId = 1;
// $product = $obj->get('Magento\Catalog\Model\ProductRepository')
               // ->getById($productId);
 
// echo '<pre>';
// print_r($product->getData());
// echo '</pre>';