<?php
declare(strict_types=1);

namespace Nans\RequestPrice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Nans\RequestPrice\Api\Data\RequestInterface;

class Request extends AbstractDb
{
    const MAIN_TABLE = 'request_price';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, RequestInterface::KEY_ID);
    }
}
