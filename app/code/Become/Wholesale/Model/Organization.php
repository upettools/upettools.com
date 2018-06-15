<?php

namespace Become\Wholesale\Model;

class Organization
{
    const ORGANIZATION_AQUA_COMPAMY = 1;
    const ORGANIZATION_AQUARIUM = 2;
    const ORGANIZATION_DROPSHIPPING = 3;
    /**
     * get available statuses.
     *
     * @return []
     */
    public static function getAvailableCategory()
    {
        return [
                self::ORGANIZATION_AQUA_COMPAMY => __('Aqua Company')
			  , self::ORGANIZATION_AQUARIUM => __('Aquarium')
			  , self::ORGANIZATION_DROPSHIPPING => __('Dropshipping'),
        ];
    }
}
