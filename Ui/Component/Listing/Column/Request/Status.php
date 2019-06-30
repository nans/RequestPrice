<?php

namespace Nans\RequestPrice\Ui\Component\Listing\Column\Request;

use Magento\Framework\Exception\NotFoundException;
use Magento\Ui\Component\Listing\Columns\Column;
use Nans\RequestPrice\Api\Data\RequestInterface;

class Status extends Column
{
    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                try {
                    $item[$this->getName()] = self::getStatusName($item[RequestInterface::KEY_STATUS]);
                } catch (\Exception $exception) {
                    $item[$this->getName()] = __('Undefined');
                }
            }
        }

        return $dataSource;
    }

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            RequestInterface::STATUS_NEW => __('New')->getText(),
            RequestInterface::STATUS_CLOSED => __('Closed')->getText(),
            RequestInterface::STATUS_IS_PROGRESS => __('In progress')->getText()
        ];
    }

    /**
     * @param int $status
     * @return string
     * @throws NotFoundException
     */
    public static function getStatusName(int $status): string
    {
        $statuses = self::getStatuses();
        if (!key_exists($status, $statuses)) {
            throw new NotFoundException(__('Status not found'));
        }

        return self::getStatuses()[$status];
    }
}