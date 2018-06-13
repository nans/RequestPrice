<?php

namespace Nans\RequestPrice\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Nans\RequestPrice\Api\Data\RequestInterface;

class RequestActions extends Column
{
    /** Url path */
    const PATH_EDIT = 'request/price/edit';
    const PATH_DELETE = 'request/price/delete';

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * QuestionActions constructor.
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item[RequestInterface::KEY_ID])) {
                    $item[$name]['edit'] = [
                        'href'  => $this->urlBuilder->getUrl(
                            self::PATH_EDIT, ['id' => $item[RequestInterface::KEY_ID]]
                        ),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href'    => $this->urlBuilder->getUrl(
                            self::PATH_DELETE,
                            ['id' => $item[RequestInterface::KEY_ID]]
                        ),
                        'label'   => __('Delete'),
                        'confirm' => [
                            'title'   => __('Delete') . ' ' . $item[RequestInterface::KEY_NAME],
                            'message' => __(
                                'Are you sure you wan\'t to delete a record?'
                            )
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
