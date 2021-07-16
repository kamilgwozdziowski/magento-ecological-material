<?php


namespace MylSoft\EcologicalMaterials\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package MylSoft\EcologicalMaterials\Helper
 */
class Config extends AbstractHelper
{
    const XML_PATH = 'product_attributes/settings/';

    /**
     * @return int
     */
    public function isEnabled(): int
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH . 'enable', ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return int
     */
    public function isEcologic(): int
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH . 'ecologic', ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function isProviderSynthetic(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH . 'provider_synthetic', ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function isProviderCotton(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH . 'provider_cotton', ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function showEcologic(): bool
    {
        if (($this->isEnabled() == 1 && $this->isEcologic() == 0) || $this->isEnabled() == 0) {
            return false;
        }
        return true;
    }
}
