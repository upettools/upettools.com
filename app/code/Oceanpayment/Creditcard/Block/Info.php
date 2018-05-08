<?php
/**
 * Copyright © 2016 Oceanpayment Design. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Oceanpayment\Creditcard\Block;

class Info extends \Magento\Payment\Block\Info
{
    /**
     * @var string
     */
    protected $_payableTo;

    /**
     * @var string
     */
    protected $_mailingAddress;

    /**
     * @var string
     */
    protected $_template = 'Oceanpayment_Creditcard::info.phtml';

    
    public function getMethodCode()
    {
        return $this->getInfo()->getMethodInstance()->getCode();
    }

    /**
     * @return string
     */
    public function toPdf()
    {
        //$this->setTemplate('Oceanpayment_Creditcard::info/pdf/checkmo.phtml');
        $this->setTemplate('Oceanpayment_Creditcard::pdf/info.phtml');
        return $this->toHtml();
    }
}
