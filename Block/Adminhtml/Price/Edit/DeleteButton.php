<?php

namespace Nans\RequestPrice\Block\Adminhtml\Price\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function getButtonData()
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
