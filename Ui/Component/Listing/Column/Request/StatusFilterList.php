<?php

namespace Nans\RequestPrice\Ui\Component\Listing\Column\Request;

use Magento\Framework\Data\OptionSourceInterface;

class StatusFilterList implements OptionSourceInterface
{
    /**
     * @var array
     */
    protected $_options;

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->_options === null) {
            $this->_options = [];

            foreach (Status::getStatuses() as $key => $value) {
                $this->_options[] = [
                    'value' => $key,
                    'label' => $value
                ];
            }
        }
        return $this->_options;
    }
}