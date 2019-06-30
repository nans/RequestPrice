<?php

namespace Nans\RequestPrice\Ui\Component\Listing\Column\Request;

use Magento\Framework\Data\OptionSourceInterface;

class StatusFilterList implements OptionSourceInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray():array
    {
        if ($this->options === null) {
            $this->options = [];

            foreach (Status::getStatuses() as $key => $value) {
                $this->options[] = [
                    'value' => $key,
                    'label' => $value
                ];
            }
        }

        return $this->options;
    }
}