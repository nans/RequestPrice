<?php
declare(strict_types=1);

namespace Nans\RequestPrice\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Nans\RequestPrice\Model\ResourceModel\Request as ResourceModel;
use Nans\RequestPrice\Api\Data\RequestInterface;

class Request extends AbstractModel implements RequestInterface
{
    const CACHE_TAG = 'request_price';

    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * @return void
     * @throws LocalizedException
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
    public function getIdentities():array
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
    public function setName(string $name): void
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
    public function setEmail(string $email): void
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
    public function setSku(string $sku): void
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
    public function setComment(string $comment): void
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
    public function setStatus(int $status): void
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
