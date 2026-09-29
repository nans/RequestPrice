<?php

declare(strict_types=1);

namespace Nans\RequestPrice\Block\Adminhtml\Price\Edit;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     * @throws NotFoundException
     */
    public function getButtonData(): array
    {
        $data = [];
        $requestId = $this->getRequestId();
        if ($requestId && $this->canRender('delete')) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->urlBuilder->getUrl('*/*/delete', ['id' => $requestId]) . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
}
