<?php

namespace MylSoft\EcologicalMaterials\Block\Adminhtml\Sales\Order;

class Eco extends \Magento\Sales\Block\Adminhtml\Items\Column\DefaultColumn
{
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
