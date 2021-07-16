<?php

namespace MylSoft\EcologicalMaterials\Block\Adminhtml\Sales\Order;

use Magento\Sales\Block\Adminhtml\Items\Column\DefaultColumn;

/**
 * Class Eco
 * @package MylSoft\EcologicalMaterials\Block\Adminhtml\Sales\Order
 */
class Eco extends DefaultColumn
{
    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function isEcological()
    {
        $item = $this->getItem();
        $product = $item->getProduct();
        $ecological = $product->getEcological();
        if(is_null($ecological)) {
            return '-';
        }

        return $ecological == 1 ? __('Yes') : __('No');
    }
}
