<?php
declare(strict_types=1);

namespace Nans\RequestPrice\Ui\Component\Listing\Column\Request;

use Magento\Framework\Data\OptionSourceInterface;

class StatusFilterList implements OptionSourceInterface
{
    /**
     * @var array
     */
    protected array $options = [];

    /**
     * @return array
     */
    public function toOptionArray():array
    {
        if (count($this->options) === 0) {
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
