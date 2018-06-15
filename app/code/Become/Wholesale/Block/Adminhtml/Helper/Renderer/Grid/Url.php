<?php
namespace Become\Wholesale\Block\Adminhtml\Helper\Renderer\Grid;

class Url extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * Store manager.
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;


    protected $_shopbrandFactory;

    /**
     * [__construct description].
     *
     * @param \Magento\Backend\Block\Context              $context
     * @param \Magento\Store\Model\StoreManagerInterface  $storeManager
     * @param \Magento\Cms\Model\BlockFactory $blockFactory
     * @param array                                       $data
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Become\Wholesale\Model\ShopwholesaleFactory $shopbrandFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_shopbrandFactory  = $shopbrandFactory;
    }

    /**
     * Render action.
     *
     * @param \Magento\Framework\DataObject $row
     *
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $storeViewId = $this->getRequest()->getParam('store');
        $urlFiles = $this->_shopbrandFactory->create()->setStoreViewId($storeViewId)->load($row->getId());
        $urlLink = $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ) . $urlFiles->getFilesNameUrl();

        //return '<image width="150" height="50" src ="'.$srcImage.'" alt="'.$brand->getImage().'" >';
		return '<a target="_blank" href="'.$urlLink.'">'.$urlFiles->getFilesNameUrl().'</a>';
    }
}
