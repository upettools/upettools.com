<?php

namespace Become\Wholesale\Model\ResourceModel\Shopwholesale;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Become\Wholesale\Model\Shopwholesale', 'Become\Wholesale\Model\ResourceModel\Shopwholesale');
    }
}
