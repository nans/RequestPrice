<?php
declare(strict_types=1);

namespace Nans\RequestPrice\Model\ResourceModel\Request;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Nans\RequestPrice\Api\Data\RequestInterface;
use Nans\RequestPrice\Model\Request as Model;
use Nans\RequestPrice\Model\ResourceModel\Request as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = RequestInterface::KEY_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
