<?php

namespace Become\Supplier\Model\ResourceModel;

class Shopsupplier extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('shop_supplier', 'shop_supplier_id');
    }
}
