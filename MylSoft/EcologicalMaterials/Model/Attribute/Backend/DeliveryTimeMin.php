<?php

namespace MylSoft\EcologicalMaterials\Model\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;

/**
 * Class DeliveryTimeMin
 * @package MylSoft\EcologicalMaterials\Model\Attribute\Backend
 */
class DeliveryTimeMin extends AbstractBackend
{
    private $_minValue = 10;

    /**
     * @param \Magento\Framework\DataObject $object
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function validate($object)
    {
        $value = (int)$object->getData($this->getAttribute()->getAttributeCode());
        if (!is_int($value)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The value delivery_time_min must be an integer')
            );
        }
        if ($value > $this->_minValue) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The value delivery_time_min must be below ' . $this->_minValue)
            );
        }

        return true;
    }
}
