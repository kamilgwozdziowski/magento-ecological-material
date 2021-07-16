<?php

namespace MylSoft\EcologicalMaterials\Block\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;

class Info extends \Magento\Framework\View\Element\Template
{
    private $_registry;
    private $_productRepository;
    private $_product;
    private $_eavConfig;
    private $_config;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Eav\Model\Config $eavConfig,
        \MylSoft\EcologicalMaterials\Helper\Config $config,
        ProductRepositoryInterface $productRepository,
        array $data = []
    )
    {
        $this->_config = $config;
        $this->_registry = $registry;
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

    /**
     * Get product id
     *
     * @return int|null
     */
    protected function getProductId()
    {
        $product = $this->_registry->registry('product');
        return $product ? $product->getId() : null;
    }

    protected function getProduct()
    {
        if (!$this->_registry->registry('product') && $this->getProductId()) {
            $product = $this->_productRepository->getById($this->getProductId());
            $this->_registry->register('product', $product);
        }
        return $this->_registry->registry('product');
    }
}
