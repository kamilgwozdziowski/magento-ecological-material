<?php

namespace MylSoft\EcologicalMaterials\Block\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Session as CatalogSession;
use Magento\Eav\Model\Config as EAVConfig;
use MylSoft\EcologicalMaterials\Helper\Config;

/**
 * Class Info
 * @package MylSoft\EcologicalMaterials\Block\Product
 */
class Info extends Template
{
    /**
     * @var ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * @var \Magento\Catalog\Api\Data\ProductInterface
     */
    private $_product;

    /**
     * @var EAVConfig
     */
    private $_eavConfig;

    /**
     * @var Config
     */
    private $_config;

    /**
     * @var CatalogSession
     */
    private $_catalogSession;

    /**
     * Info constructor.
     * @param Template\Context $context
     * @param EAVConfig $eavConfig
     * @param Config $config
     * @param ProductRepositoryInterface $productRepository
     * @param CatalogSession $catalogSession
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        EAVConfig $eavConfig,
        Config $config,
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

    /**
     * @return int|null
     */
    public function getDeliveryTimeMin(): ?int
    {
        return $this->_product->getDeliveryTimeMin();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
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

    /**
     * @return int
     */
    public function getDeliveryTimeMax(): int
    {
        return $this->_product->getDeliveryTimeMax();
    }

    /**
     * @return bool
     */
    public function showEco(): bool
    {
        return $this->_config->showEcologic();
    }

    /**
     * @return bool
     */
    public function showEnableMaterialDeliveryTime(): bool
    {
        return (bool)$this->_config->isEnabled();
    }

    /**
     * @return bool
     */
    public function isEco(): bool
    {
        $productTypeId = $this->_product->getTypeId();
        if($productTypeId != 'configurable') {
            return '';
        }

        return $this->_product->getEcological();
    }

    /**
     * @return \Magento\Catalog\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function getProduct()
    {
        $productId = $this->_catalogSession->getData('last_viewed_product_id');
        return $this->_productRepository->getById($productId);
    }
}
