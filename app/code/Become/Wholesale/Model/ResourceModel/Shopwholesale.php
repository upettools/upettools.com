<?php

namespace Become\Wholesale\Model\ResourceModel;

class Shopwholesale extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('shop_wholesale', 'shop_wholesale_id');
    }
}
