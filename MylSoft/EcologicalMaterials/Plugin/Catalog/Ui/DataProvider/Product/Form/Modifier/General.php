<?php

namespace MylSoft\EcologicalMaterials\Plugin\Catalog\Ui\DataProvider\Product\Form\Modifier;

class General
{
    private $_config;

    public function __construct(
        \MylSoft\EcologicalMaterials\Helper\Config $config
    )
    {
        $this->_config = $config;
    }

    public function afterModifyMeta(
        \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\General $subject,
        $meta
    )
    {
        if ($this->_config->isEnabled() == 0) {
            if (isset($meta['product-details']['children']['container_delivery_time_max'])) {
                $meta['product-details']['children']['container_delivery_time_max']['children']['delivery_time_max']['arguments']['data']['config']['visible'] = 0;
            }
            if (isset($meta['product-details']['children']['container_delivery_time_min'])) {
                $meta['product-details']['children']['container_delivery_time_min']['children']['delivery_time_min']['arguments']['data']['config']['visible'] = 0;
            }
            if (isset($meta['product-details']['children']['container_material'])) {
                $meta['product-details']['children']['container_material']['children']['material']['arguments']['data']['config']['visible'] = 0;
            }
        }

        if (!$this->_config->showEcologic()) {
            if (isset($meta['product-details']['children']['container_ecological'])) {
                $meta['product-details']['children']['container_ecological']['children']['ecological']['arguments']['data']['config']['visible'] = 0;
            }
        }

        return $meta;
    }
}
