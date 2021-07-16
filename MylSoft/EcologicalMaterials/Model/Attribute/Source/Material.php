<?php

namespace MylSoft\EcologicalMaterials\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * Class Material
 * @package MylSoft\EcologicalMaterials\Model\Attribute\Source
 */
class Material extends AbstractSource
{

    /**
     * @return array
     */
    public function getAllOptions(): array
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Cotton'), 'value' => 'cotton'],
                ['label' => __('Polyester'), 'value' => 'polyester'],
                ['label' => __('Viscose'), 'value' => 'viscose'],
            ];
        }
        return $this->_options;
    }
}
