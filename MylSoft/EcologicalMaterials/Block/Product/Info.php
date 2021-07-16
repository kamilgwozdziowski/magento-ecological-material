<?php

namespace MylSoft\EcologicalMaterials\Block\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Session as CatalogSession;

class Info extends \Magento\Framework\View\Element\Template
{
    private $_productRepository;
    private $_product;
    private $_eavConfig;
    private $_config;
    private $_catalogSession;

    public function __construct(
        Template\Context $context,
        \Magento\Eav\Model\Config $eavConfig,
        \MylSoft\EcologicalMaterials\Helper\Config $config,
        ProductRepositoryInterface $productRepository,
        CatalogSession $catalogSession,
        array $data = []
    )
    {
        $this->_config = $config;
        $this->_catalogSession = $catalogSession;
        $this->_productRepository = $productRepository;
        $this->_eavConfig = $eavConfig;
        $this->_product = $this->getProduct();
        parent::__construct($context, $data);
    }

    public function getDeliveryTimeMin(): ?int
    {
        return $this->_product->getDeliveryTimeMin();
    }

    public function getMaterial(): string
    {
        $productTypeId = $this->_product->getTypeId();
        if($productTypeId != 'simple') {
            return '';
        }

        $materialCode = $this->_product->getMaterial();
        if (empty($materialCode)) {
            return '';
        }
        $attribute = $this->_eavConfig->getAttribute('catalog_product', 'material');
        $option = $attribute->getSource()->getOptionText($materialCode);

        return $option;
    }

    public function getDeliveryTimeMax(): int
    {
        return $this->_product->getDeliveryTimeMax();
    }

    public function showEco(): bool
    {
        return $this->_config->showEcologic();
    }

    public function showEnableMaterialDeliveryTime(): bool
    {
        return (bool)$this->_config->isEnabled();
    }

    public function isEco(): bool
    {
        $productTypeId = $this->_product->getTypeId();
        if($productTypeId != 'configurable') {
            return '';
        }

        return $this->_product->getEcological();
    }

    protected function getProduct()
    {
        $productId = $this->_catalogSession->getData('last_viewed_product_id');
        return $this->_productRepository->getById($productId);
    }
}
