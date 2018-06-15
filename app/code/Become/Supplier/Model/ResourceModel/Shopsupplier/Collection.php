<?php

namespace Become\Supplier\Model\ResourceModel\Shopsupplier;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Become\Supplier\Model\Shopsupplier', 'Become\Supplier\Model\ResourceModel\Shopsupplier');
    }
}
