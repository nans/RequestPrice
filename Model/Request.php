<?php

namespace Nans\RequestPrice\Model;

use Magento\Framework\Model\AbstractModel;
use Nans\RequestPrice\Model\ResourceModel\Request as ResourceModel;
use Nans\RequestPrice\Api\Data\RequestInterface;

class Request extends AbstractModel implements RequestInterface
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'request_price';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::KEY_NAME);
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->setData(self::KEY_NAME, $name);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(self::KEY_EMAIL);
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->setData(self::KEY_EMAIL, $email);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->getData(self::KEY_SKU);
    }

    /**
     * @param string $sku
     * @return void
     */
    public function setSku(string $sku)
    {
        $this->setData(self::KEY_SKU, $sku);
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->getData(self::KEY_COMMENT);
    }

    /**
     * @param string $comment
     * @return void
     */
    public function setComment(string $comment)
    {
        $this->setData(self::KEY_COMMENT, $comment);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->getData(self::KEY_STATUS);
    }

    /**
     * @param int $status
     * @return void
     */
    public function setStatus(int $status)
    {
        $this->setData(self::KEY_STATUS, $status);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }
}