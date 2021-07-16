<?php

namespace MylSoft\EcologicalMaterials\Model\Attribute\Backend;

class DeliveryTimeMax extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    private $_minValue = 10;

    public function validate($object)
    {
        $value = (int)$object->getData($this->getAttribute()->getAttributeCode());
        if (!is_int($value)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The value delivery_time_max must be an integer')
            );
        }
        if ($value < $this->_minValue) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The value delivery_time_max must be below ' . $this->_minValue)
            );
        }

        return true;
    }
}
