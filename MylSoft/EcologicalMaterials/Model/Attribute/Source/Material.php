<?php

namespace MylSoft\EcologicalMaterials\Model\Attribute\Source;

class Material extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    public function getAllOptions()
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
